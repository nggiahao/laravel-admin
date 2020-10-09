<?php


namespace Tessa\Admin\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Tessa\Admin\Crud\Crud;

class CrudController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /** @var Crud */
    public $crud;

    public $data;

    public function setup() {
        //
    }

    protected function init($operation) {
        $this->crud = app('crud')->setOperation($operation);
        $this->crud->loadDefaultOperationSettingsFromConfig();

        $this->setup();
        $this->setupConfigurationForCurrentOperation();
    }

    protected function setupConfigurationForCurrentOperation()
    {
        $operation_name = $this->crud->getOperation();
        $setup_class_name = 'setup' . Str::studly($operation_name) . 'Operation';

        if (method_exists($this, $setup_class_name)) {
            $this->{$setup_class_name}();
        }

    }
}