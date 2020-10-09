<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait CreateOperation
{
    
    public function create() {

        $this->init('create');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::create', $this->data);
    }

    public function store(Request $request) {
        $this->init('create');

        $entry = $this->crud->create($request->all());

        return redirect()->back();
    }


}