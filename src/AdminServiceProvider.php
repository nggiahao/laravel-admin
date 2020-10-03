<?php

namespace Tessa\Admin;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function setupRoutes()
    {
        $route = __DIR__.$this->route_file_path;
        $custom_route = __DIR__.$this->custom_route_file_path;

        $this->loadRoutesFrom($route);
        $this->loadRoutesFrom($custom_route);
    }

    /**
     * Publish files
     */
    public function publishFiles()
    {
        $tessa_config = [__DIR__.'/../config' => config_path()];

        $tessa_public = [__DIR__.'/../public' => public_path()];

        $this->publishes($tessa_config, 'config');
        $this->publishes($tessa_public, 'public');
    }

    public function loadViews() {
        $custom_base_folder = resource_path('views/admin/base');
        $custom_crud_folder = resource_path('views/admin/crud');

        // - first the published/overwritten views (in case they have any changes)
        if (file_exists($custom_base_folder)) {
            $this->loadViewsFrom($custom_base_folder, config('admin.base.namespace_view', 'tessa_admin'));
        }
        if (file_exists($custom_crud_folder)) {
            $this->loadViewsFrom($custom_crud_folder, 'crud');
        }

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views/base'), config('admin.base.namespace_view', 'tessa_admin'));
        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views/crud'), 'crud');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return void
     */
    public function provides()
    {
        //
    }

}
