<?php


namespace Tessa\Admin\Crud\Traits;


use Illuminate\Database\Eloquent\Builder;

trait Query
{
    /** @var Builder */
    public $query;

    public function query() {
        return $this->query;
    }

    public function setQuery($query) {
        $this->query = $query;

        return $this;
    }
}