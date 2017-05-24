<?php
use Partham\core\services\ServerService;

class StrategyDuckTest extends PHPUnit\Framework\TestCase
{
    public function testDogDuck()
    {
        $server = new ServerService();
        $expected = "Hello World";

        $this->assertEquals($expected, $server->info());
    }
}
