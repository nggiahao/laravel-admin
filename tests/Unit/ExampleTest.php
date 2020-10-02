<?php


namespace Tessa\Admin\Tests\Unit;


use Tessa\Admin\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @environment-setup useMySqlConnection
     */
    public function test_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function it_runs_the_migrations() {
        $this->loadLaravelMigrations();
    }
}