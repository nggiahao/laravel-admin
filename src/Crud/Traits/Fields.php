<?php


namespace Tessa\Admin\Crud\Traits;


trait Fields
{
    /**
     * Get the CRUD fields for the current operation.
     *
     * @return array CRUD columns.
     */
    public function fields()
    {
        return $this->get('fields', []);
    }

    /**
     * Add a field at the end of to the CRUD object's "fields" array.
     *
     * @param array|string $column
     *
     * @return self
     */
    public function addField($column)
    {
        $this->addFieldToSettings($column);

        return $this;
    }

    public function addFieldToSettings($column) {
        $columns = array_merge($this->columns(), [$column]);

        $this->set('fields', $columns);
    }
}