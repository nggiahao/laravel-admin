<?php


namespace Tessa\Admin\Crud\Traits;


trait Update
{
    public function update($id ,$data) {
        $entry = $this->getModel()->findOrFail($id);

        if ($entry->update($data)) {
            return $entry;
        } else {
            return false;
        }
    }
}