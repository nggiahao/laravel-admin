<?php


namespace Tessa\Admin\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tessa\Admin\AdminServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            AdminServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // make sure, our .env file is loaded
        $app->useEnvironmentPath(__DIR__.'/../');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
    }

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }
}