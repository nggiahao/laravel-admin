<?php


namespace Tessa\Admin\Crud\Traits;


trait Delete
{
    /**
     * @param $id
     *
     * TODO: should this delete items with relations to it too?
     * @return false
     */
    public function delete($id) {
        $entry = $this->getModel()->findOrFail($id);

        return $entry->delete();
    }
}