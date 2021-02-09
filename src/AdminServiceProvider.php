<?php

namespace Tessa\Admin;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tessa\Admin\Crud\CrudPanel;
use Tessa\Admin\Http\Controllers\CrudController;
use Tessa\Admin\Http\Middleware\Authenticate;

class AdminServiceProvider extends ServiceProvider
{

    protected $commands = [];

    protected $route_file_path = '/../routes/base.php';
    protected $custom_route_file_path = '/../routes/custom.php';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
//        $this->loadTranslationsFrom();
        $this->loadConfigs();
        $this->pushMiddleware();
        $this->setupRoutes();
        $this->publishFiles();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('crud', function () {
            return new CrudPanel();
        });

        $this->addRouteMacro();

        $this->loadViews();
        $this->loadHelpers();
    }

    /**
     * Load the Tessa helper methods, for convenience.
     */
    public function loadHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

    /**
     * Load configs
     */
    public function loadConfigs()
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(__DIR__.'/../config/admin/base.php', 'admin.base');
        $this->mergeConfigFrom(__DIR__.'/../config/admin/crud.php', 'admin.crud');

        app()->config['auth.providers'] = app()->config['auth.providers'] +
            app()->config['admin.base.auth.providers'];

        app()->config['auth.passwords'] = app()->config['auth.passwords'] +
            app()->config['admin.base.auth.passwords'];

        app()->config['auth.guards'] = app()->config['auth.guards'] +
            app()->config['admin.base.auth.guards'];
    }

    /**
     * Push middleware
     */
    public function pushMiddleware()
    {
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('auth.admin', Authenticate::class);
        $router->pushMiddlewareToGroup('auth.admin', ConvertEmptyStringsToNull::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function setupRoutes()
    {
        $route = __DIR__.$this->route_file_path;
        $custom_route = base_path('/routes/admin/custom.php');

        $this->loadRoutesFrom($route);
        $this->loadRoutesFrom($custom_route);
    }

    /**
     *
     */
    public function addRouteMacro()
    {
        if (!Route::hasMacro('crud')) {
            Route::macro('crud', function ($name, $controller) {
                $route_name = 'admin.'.$name;

                /** @var Router $this */
                if ($this->hasGroupStack()) {
                    $group_stack = $this->getGroupStack();
                    $group_namespace = $group_stack && isset(end($group_stack)['namespace']) ? end($group_stack)['namespace'].'\\' : '';
                } else {
                    $group_namespace = '';
                }
                $namespace_controller = $group_namespace.$controller;

                return $namespace_controller::setupRoutes($name, $route_name, $controller);
            });
        }
    }

    /**
     * Publish files
     */
    public function publishFiles()
    {
//        $error_views = [__DIR__.'/resources/error_views' => resource_path('views/errors')];
        $config = [__DIR__.'/../config' => config_path()];
        $public = [__DIR__.'/../public' => public_path()];
//        $lang_files = [__DIR__.'/resources/lang' => resource_path('lang/vendor')];
        $route = [__DIR__.$this->custom_route_file_path => base_path('/routes/admin/custom.php')];

        $this->publishes($config, 'config');
        $this->publishes($route, 'route');
        $this->publishes($public, 'public');
//        $this->publishes($error_views, 'errors');
//        $this->publishes($lang_files, 'lang');
    
    }

    public function loadViews() {
        $custom_base_folder = resource_path('views/admin/base');
        $custom_crud_folder = resource_path('views/admin/crud');

        // - first the published/overwritten views (in case they have any changes)
        if (file_exists($custom_base_folder)) {
            $this->loadViewsFrom($custom_base_folder, config('admin.base.namespace_view', 'admin'));
        }
        if (file_exists($custom_crud_folder)) {
            $this->loadViewsFrom($custom_crud_folder, 'crud');
        }
    
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views/base'), config('admin.base.namespace_view', 'admin'));
        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views/crud'), 'crud');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['crud'];
    }

}
