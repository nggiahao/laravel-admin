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
        return $this->get('columns', []);
    }

    public function columns_name() {
        $columns_name = [];

        foreach ($this->columns() as $column) {
            $columns_name = $column['name'];
        }

        return $columns_name;

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
        $this->addColumnToSettings($column);

        return $this;
    }

    public function addColumnToSettings($column) {
        $columns = array_merge($this->columns(), [$column]);

        $this->set('columns', $columns);
    }
}