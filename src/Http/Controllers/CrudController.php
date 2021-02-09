<?php


namespace Tessa\Admin\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Tessa\Admin\Crud\CrudPanel;

class CrudController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /** @var CrudPanel */
    public $crud;

    public $data;

    public function __construct() {
        
        if ($this->crud) {
            return;
        }
        
        $this->middleware(function ($request, $next) {
            $operation = \Route::getCurrentRoute()->action['operation'];

            $this->crud = app('crud')->setOperation($operation);

            $this->setupDefault();
            $this->setup();

            return $next($request);
        });
    }


    public function setup() {
        $this->crud->loadDefaultOperationSettingsFromConfig();
        $this->setupConfigurationForCurrentOperation();
    }

    public function setupDefault() {

        preg_match_all('/(?<=^|;)(setup([^;]+?)Default)(;|$)/', implode(';', get_class_methods($this)), $matches);

        if (count($matches[1])) {
            foreach ($matches[1] as $method) {
                $this->{$method}();
            }
        }
    }

    protected function setupConfigurationForCurrentOperation()
    {
        $operation_name = $this->crud->getOperation();
        $setup_class_name = 'setup' . Str::studly($operation_name) . 'Operation';

        if (method_exists($this, $setup_class_name)) {
            $this->{$setup_class_name}();
        }

    }
    
    public static function setupRoutes($segment, $route_name, $controller)
    {
        preg_match_all('/(?<=^|;)(setup([^;]+?)Routes)(;|$)/', implode(';', get_class_methods(static::class)), $matches);
        
        if (count($matches[1])) {
            foreach ($matches[1] as $method) {
                static::{$method}($segment, $route_name, $controller);
            }
        }
    }
}