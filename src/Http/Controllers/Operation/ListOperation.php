<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
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

    public function search(Request $request) {
        $this->init('list');

        //TODO: apply filter
        //
        $total_records = $this->crud->model->count();
        $filtered_records = $this->crud->query->count();

        $start_index = $request->input('start') ?: 0;
        if ($start_index) {
            $this->crud->query = $this->crud->query->skip($start_index);
        }
        $length = $request->input('length') ?: 25;
        if ($length) {
            $this->crud->query = $this->crud->query->take($length);
        }

        $order = $request->input('order');
        if ($order) {
            $order_column = ($this->crud->columns())[$order['column']];
            $this->crud->query = $this->crud->query->orderBy($order_column['name'], $order['direction']);
        }

        $entries = $this->crud->query->get();

        $data = [];
        foreach ($entries as $entry) {
            $data[] = $this->getEntryView($entry);
        }

        return response()->json([
            'total_records' => $total_records,
            'filtered_records' => $filtered_records,
            'data' => $data
        ]);
    }

    public function getEntryView($entry) {
        $row = [];

        foreach ($this->crud->columns() as $column) {
            $column_name = $column['name'];
            $row[] = "<span>". $entry->$column_name ."</span>";
        }

        return $row;
    }

}