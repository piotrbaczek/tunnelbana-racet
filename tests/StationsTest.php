<?php

namespace pbaczek\tunnelbanarace\tests;

use pbaczek\tunnelbanarace\tests\Stations\StationOne;
use pbaczek\tunnelbanarace\tests\Stations\StationTwo;
use PHPUnit\Framework\TestCase;

class StationsTest extends TestCase
{
    /**
     * Tests that cloning stations also copies their respective connections
     * @return void
     */
    public function testCloningStations(): void
    {
        $stationOne = new StationOne();
        $stationTwo = new StationTwo();

        $stationOne->addDualConnections($stationTwo, 5);

        $this->assertCount(1, $stationOne->getConnectionsList()->getConnections()->toArray());

        $clonedStationOne = clone $stationOne;

        $clonedStationOne->getConnectionsList()->getConnections()->clear();

        $this->assertCount(1, $stationOne->getConnectionsList()->getConnections()->toArray());
        $this->assertCount(0, $clonedStationOne->getConnectionsList()->getConnections()->toArray());
    }
}