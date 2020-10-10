<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UpdateOperation
{
    
    public function edit($id) {

        $this->init('update');

        $this->data['id'] = $id;
        $this->data['entry'] = $this->crud->getModel()->findOrFail($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::update', $this->data);
    }

    public function update(Request $request, $id) {
        $this->init('update');

        $entry = $this->crud->update($id, $request->all());

        return redirect($this->crud->getRoute());
    }


}