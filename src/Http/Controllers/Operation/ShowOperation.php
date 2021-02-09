<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait ShowOperation
{

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $route_name  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected static function setupShowRoutes($segment, $route_name, $controller)
    {
        Route::get($segment.'/show/{id}', [
            'as'        => $route_name.'.show',
            'uses'      => $controller.'@show',
            'operation' => 'show',
        ]);
    }

    protected function setupShowDefault() {
        $this->crud->allowAccess('show');
    
        $this->crud->addButton([
            'stack' => 'line',
            'view' => 'view',
            'name' => 'show',
            'content' => 'crud::buttons.show',
        ]);
    }

    public function setupShowOperation() {
        $this->setupListOperation();
    }

    public function show($id) {

        $this->data['id'] = $id;
        $this->data['entry'] = $this->crud->getModel()->findOrFail($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::show', $this->data);
    }

}