<?php
use Partham\Server;

class StrategyDuckTest extends PHPUnit_Framework_TestCase {
    public function testDogDuck() {
        $server = new Server();
        $expected = "Hello World";

        $this->assertEquals($expected, $server->info());
    }
}
