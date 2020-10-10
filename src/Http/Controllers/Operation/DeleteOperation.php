<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait DeleteOperation
{
    
    public function delete($id) {
        $this->init('delete');

        if ($this->crud->delete($id)) {
            return response()->json(['message' => 'OK'], 200);
        } else {
            return response()->json(['message' => 'Fail'], 500);
        }
    }


}