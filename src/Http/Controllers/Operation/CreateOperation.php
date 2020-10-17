<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait CreateOperation
{

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $route_name  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCreateRoutes($segment, $route_name, $controller)
    {
        Route::get($segment.'/create', [
            'as'        => $route_name.'.create',
            'uses'      => $controller.'@create',
            'operation' => 'create',
        ]);

        Route::post($segment.'/store', [
            'as'        => $route_name.'.store',
            'uses'      => $controller.'@store',
            'operation' => 'create',
        ]);
    }
    
    public function create() {


        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::create', $this->data);
    }

    public function store(Request $request) {

        $entry = $this->crud->create($request->all());

        return redirect()->back();
    }


}