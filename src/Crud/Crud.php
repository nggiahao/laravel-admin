<?php


namespace Tessa\Admin\Crud;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use Tessa\Admin\Crud\Traits\Columns;
use Tessa\Admin\Crud\Traits\Setting;

class Crud
{
    use Setting, Columns;
    use Macroable;

    /** @var Model */
    public $model;
    /** @var Builder */
    public $query;

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
        $this->query = $this->model->newQuery();
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