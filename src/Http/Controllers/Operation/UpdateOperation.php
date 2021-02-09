<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait UpdateOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $route_name  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected static function setupUpdateRoutes($segment, $route_name, $controller)
    {
        Route::get($segment.'/edit/{id}', [
            'as'        => $route_name.'.edit',
            'uses'      => $controller.'@edit',
            'operation' => 'update',
        ]);

        Route::post($segment.'/update/{id}', [
            'as'        => $route_name.'.update',
            'uses'      => $controller.'@update',
            'operation' => 'update',
        ]);
    }

    protected function setupUpdateDefault() {
        $this->crud->allowAccess('update');
    
        $this->crud->addButton([
            'stack' => 'line',
            'view' => 'view',
            'name' => 'update',
            'content' => 'crud::buttons.update',
        ]);
    }

    public function setupUpdateOperation() {
        $this->setupCreateOperation();
    }

    public function edit($id) {


        $this->data['id'] = $id;
        $this->data['entry'] = $this->crud->getModel()->findOrFail($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::update', $this->data);
    }

    public function update(Request $request, $id) {

        $entry = $this->crud->update($id, $request->all());

        return redirect($this->crud->getRoute());
    }


}