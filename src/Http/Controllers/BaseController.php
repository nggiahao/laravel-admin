<?php


namespace Tessa\Admin\Http\Controllers;


use Tessa\Admin\Http\Controllers\Operation\CreateOperation;
use Tessa\Admin\Http\Controllers\Operation\DeleteOperation;
use Tessa\Admin\Http\Controllers\Operation\ListOperation;
use Tessa\Admin\Http\Controllers\Operation\ShowOperation;
use Tessa\Admin\Http\Controllers\Operation\UpdateOperation;

class BaseController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ShowOperation;
}