<?php
use Partham\core\Server;

class StrategyDuckTest extends PHPUnit\Framework\TestCase
{
    public function testDogDuck()
    {
        $server = new Server();
        $expected = "Hello World";

        $this->assertEquals($expected, $server->info());
    }
}
