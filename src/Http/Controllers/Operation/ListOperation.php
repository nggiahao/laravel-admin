<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait ListOperation
{

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $route_name  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupListRoutes($segment, $route_name, $controller)
    {
        Route::get($segment.'/', [
            'as'        => $route_name.'.index',
            'uses'      => $controller.'@index',
            'operation' => 'list',
        ]);

        Route::get($segment.'/search', [
            'as'        => $route_name.'.search',
            'uses'      => $controller.'@search',
            'operation' => 'list',
        ]);

//        Route::get($segment.'/{id}/details', [
//            'as'        => $route_name.'.showDetailsRow',
//            'uses'      => $controller.'@showDetailsRow',
//            'operation' => 'list',
//        ]);
    }

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