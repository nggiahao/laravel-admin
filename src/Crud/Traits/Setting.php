<?php


namespace Tessa\Admin\Crud\Traits;


use Illuminate\Support\Arr;

trait Setting
{
    /** @var array  */
    public $settings = [];

    public function get(string $key, $default = null) {
        return Arr::get($this->settings ,$key, $default);
    }

    public function set(string $key, $value) {
        Arr::set($this->settings, $key, $value);
        return $this;
    }

    public function has(string $key) {
        return Arr::has($this->settings, $key);
    }

    public function settings() {
        return $this->settings;
    }

    /**
     *
     * @return Setting
     */
    public function loadDefaultOperationSettingsFromConfig() {
        $operation = $this->getOperation();

        $config_operation = config("admin.crud.operations.$operation", null);
        if (is_array($config_operation) && count($config_operation)) {
            foreach ($config_operation as $key => $value) {
                $this->set('configuration.'.$key, $value);
            }
        }

        return $this;
    }
}