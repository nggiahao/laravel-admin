<?php


namespace Tessa\Admin\Crud\Traits;


use Illuminate\Support\Arr;

trait Setting
{
    /** @var string ['list', 'create', 'update', 'show', 'delete'] */
    protected $operation;

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
     * @return mixed|string
     */
    public function getOperation() {
        return $this->operation;
    }

    /**
     * @param string $operation - Operation. Ex: list(default), create, update, delete
     *
     * @return Setting
     */
    public function setOperation(string $operation) {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @param string $key
     * @param string|null $operation
     */
    public function getOperationSetting(string $key, string $operation = null) {
        $operation = $operation ?: $this->getOperation();

        return $this->get("$operation.$key");
    }

    /**
     * @param string $key
     * @param $value
     * @param string|null $operation
     *
     * @return Setting
     */
    public function setOperationSetting(string $key, $value, string $operation = null) {
        $operation = $operation ?: $this->getOperation();
        return $this->set("$operation.$key", $value);
    }

    /**
     * @param null $operation
     *
     * @return Setting
     */
    public function loadDefaultOperationSettingsFromConfig($operation = null) {
        $operation = $operation ?: $this->getOperation();


        $config_operation = config("admin.crud.operations.$operation", null);
        if (is_array($config_operation) && count($config_operation)) {
            foreach ($config_operation as $key => $value) {
                $this->setOperationSetting($key, $value, $operation);
            }
        }

        return $this;
    }
}