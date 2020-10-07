<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Support\Str;

trait ListOperation
{
    
    public function index() {

        /**
         * 1. Create (crud) with name operation, base setup operation
         * [setting => [...
         *              'columns' => ...
         *              'filters' => ...
         *              'fields' => ...
         *         ]
         * ]
         * 2. Load setting operation from config
         * 3. Load setup
         */

        $this->init('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = Str::ucfirst($this->crud->entity_name_plural);

        return view('crud::list', $this->data);
    }
}