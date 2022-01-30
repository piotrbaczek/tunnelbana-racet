<?php

namespace pbaczek\tunnelbanarace\tests;

use pbaczek\tunnelbanarace\Path;
use pbaczek\tunnelbanarace\Stations\AbstractStation\Connection;
use pbaczek\tunnelbanarace\tests\Stations\StationOne;
use pbaczek\tunnelbanarace\tests\Stations\StationThree;
use pbaczek\tunnelbanarace\tests\Stations\StationTwo;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    /**
     * Tests that paths can be cloned and all data will remain copied and not just copied references
     * @return void
     */
    public function testCloningPath(): void
    {
        $stationOne = new StationOne();
        $stationTwo = new StationTwo();
        $stationThree = new StationThree();

        $stationOne->addDualConnections($stationTwo, 5);

        $path = new Path($stationOne);
        $path->addConnection(new Connection($stationTwo, 5));

        $this->assertEquals(5, $path->getTime());
        $this->assertCount(2, $path->getPath()->toArray());
        $this->assertEquals([$stationOne->getName(), $stationTwo->getName()], $path->getPath()->getListOfStationNames());

        $clonedPath = clone $path;
        $clonedPath->addConnection(new Connection($stationThree, 10));

        $this->assertEquals(15, $clonedPath->getTime());
        $this->assertCount(3, $clonedPath->getPath()->toArray());
        $this->assertEquals([$stationOne->getName(), $stationTwo->getName(), $stationThree->getName()], $clonedPath->getPath()->getListOfStationNames());

        $this->assertEquals(5, $path->getTime());
        $this->assertCount(2, $path->getPath()->toArray());
        $this->assertEquals([$stationOne->getName(), $stationTwo->getName()], $path->getPath()->getListOfStationNames());
    }
}