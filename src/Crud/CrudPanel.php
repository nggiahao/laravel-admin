<?php


namespace Tessa\Admin\Crud;


use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use Tessa\Admin\Crud\Traits\Access;
use Tessa\Admin\Crud\Traits\Buttons;
use Tessa\Admin\Crud\Traits\Columns;
use Tessa\Admin\Crud\Traits\Create;
use Tessa\Admin\Crud\Traits\Delete;
use Tessa\Admin\Crud\Traits\Fields;
use Tessa\Admin\Crud\Traits\Query;
use Tessa\Admin\Crud\Traits\Setting;
use Tessa\Admin\Crud\Traits\Update;

class CrudPanel
{
    use Setting, Access, Query, Columns, Fields, Create, Update, Delete, Buttons;
    use Macroable;

    public $model = "\App\Models\Entity";

    /** @var string ['list', 'create', 'update', 'show', 'delete'] */
    protected $operation;

    //TODO: sửa lại route, chắc là lưu route name - Ex: admin.user;
    protected $route;
    
    public $entity_name = 'entry';
    public $entity_name_plural = 'entries';

    public $entry;

    public $request;

    /**
     * Crud constructor.
     *
     */
    public function __construct()
    {
        $this->setRequest();
    }

    /**
     * @param $entity_name
     */
    public function setEntityNameStrings($entity_name)
    {
        $this->entity_name = $entity_name;
        $this->entity_name_plural = \Str::plural($entity_name);
    }

    /**
     * @return mixed|string
     */
    public function getOperation() {
        return $this->operation;
    }

    /**
     * @param string $operation - Operation. Ex: list(default), create, update, delete
     *
     * @return Setting
     */
    public function setOperation(string $operation) {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @param string $model
     *
     * @return CrudPanel
     * @throws \Exception
     */
    public function setModel(string $model): CrudPanel
    {
        if (! class_exists($model)) {
            throw new \Exception('The model does not exist.', 500);
        }
    
//        if (! method_exists($model, 'hasCrudTrait')) {
//            throw new \Exception('Please use CrudTrait on the model.', 500);
//        }

        $this->model = new $model();
        $this->setQuery($this->model->newQuery());
        $this->entry = null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $route route name
     *
     * @return CrudPanel
     */
    public function setRoute(string $route): CrudPanel
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }
    
    /**
     *
     * @param Request|null $request
     *
     * @return CrudPanel
     */
    public function setRequest(Request $request = null): CrudPanel
    {
        $this->request = $request ?? \Request::instance();

        return $this;

    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
}