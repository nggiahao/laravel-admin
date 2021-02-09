<?php


namespace Tessa\Admin\Crud\Traits;


trait Access
{
    public function allowAccess($operation)
    {
        $this->set('access.'.$operation, true);
        return $this->hasAccess($operation);
    }
    
    public function denyAccess($operation)
    {
        $this->set('access.'.$operation, false);
        return !$this->hasAccess($operation);
    }
    
    public function hasAccess($operation)
    {
        return $this->has('access.'.$operation);
    }
}