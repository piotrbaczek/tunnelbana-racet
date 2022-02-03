<?php

namespace pbaczek\tunnelbanarace\tests\Stations\Tunnelbana;

use pbaczek\tunnelbanarace\Stations\Tunnelbana\TunnelbanaGenerator;
use PHPUnit\Framework\TestCase;

class TunnelbanaGeneratorTest extends TestCase
{
    public function testGeneration()
    {
        $tunnelbanaGenerator = new TunnelbanaGenerator();
        $stations = $tunnelbanaGenerator->buildStationsCollection();

        $this->assertCount(100, $stations);
    }
}