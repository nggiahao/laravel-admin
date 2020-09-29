<?php


namespace Tessa\Admin\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Tessa\Admin\AdminServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return AdminServiceProvider::class;
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }
}