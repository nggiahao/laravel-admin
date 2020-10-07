<?php


namespace Tessa\Admin\Crud\Traits;


trait Columns
{
    /**
     * Get the CRUD columns for the current operation.
     *
     * @return array CRUD columns.
     */
    public function columns()
    {
        return $this->getOperationSetting('columns', 'list') ?? [];
    }

    /**
     * Add a column at the end of to the CRUD object's "columns" array.
     *
     * @param array|string $column
     *
     * @return self
     */
    public function addColumn($column)
    {
        $this->addColumnToOperationSettings($column);

        return $this;
    }

    public function addColumnToOperationSettings($column) {
        $columns = array_merge($this->columns(), [$column]);

        $this->setOperationSetting('columns', $columns, 'list');
    }
}