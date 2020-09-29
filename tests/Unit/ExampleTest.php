<?php


namespace Tessa\Admin\Tests\Unit;


use Tessa\Admin\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @environment-setup useMySqlConnection
     */
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }
}