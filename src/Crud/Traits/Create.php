<?php


namespace Tessa\Admin\Crud\Traits;


trait Create
{
    public function create($data) {
        return $this->getModel()->create($data);
    }
}