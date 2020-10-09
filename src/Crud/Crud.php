<?php


namespace Tessa\Admin\Crud;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use Tessa\Admin\Crud\Traits\Columns;
use Tessa\Admin\Crud\Traits\Create;
use Tessa\Admin\Crud\Traits\Fields;
use Tessa\Admin\Crud\Traits\Query;
use Tessa\Admin\Crud\Traits\Setting;

class Crud
{
    use Setting, Query, Columns, Fields, Create;
    use Macroable;

    /** @var Model */
    public $model;

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
     * @return Crud
     * @throws \Exception
     */
    public function setModel(string $model): Crud
    {
        if (! class_exists($model)) {
            throw new \Exception('The model does not exist.', 500);
        }

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
     * @return Crud
     */
    public function setRoute(string $route): Crud
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
     * @return Crud
     */
    public function setRequest(Request $request = null): Crud
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