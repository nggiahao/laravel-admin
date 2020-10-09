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
     * @param array|string $field
     *
     * @return self
     */
    public function addField($field)
    {
        $this->addFieldToSettings($field);

        return $this;
    }

    public function addFieldToSettings($field) {
        $fields = array_merge($this->fields(), [$field]);

        $this->set('fields', $fields);
    }
}