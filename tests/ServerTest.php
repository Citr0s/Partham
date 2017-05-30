<?php

class StrategyDuckTest extends PHPUnit\Framework\TestCase
{
    public function testDogDuck()
    {
        $expected = "Hello World";

        $this->assertEquals($expected, "Hello World");
    }
}
