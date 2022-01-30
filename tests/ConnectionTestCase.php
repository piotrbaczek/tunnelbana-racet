<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Path;
use pbaczek\tunnelbanarace\PathCalculator;
use PHPUnit\Framework\TestCase;
use pbaczek\tunnelbanarace\PathCalculator\FinishConditions\CountStations;

final class ConnectionTestCase extends TestCase
{
    /**
     * Tests that in linear case we can find the final station
     * Main path 1 -> 2 -> 3
     * @return void
     */
    public function testBasicStationsTask(): void
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();

        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);

        $pathCalculator = new PathCalculator($firstStation, $thirdStation);
        $pathCalculator->addFinishCondition(new CountStations(3));

        $pathCalculator->calculate();

        /** @var Path $onlyPath */
        $onlyPath = $pathCalculator->getPaths()->first();
        $this->assertInstanceOf(Path::class, $onlyPath);

        $this->assertEquals(105, $onlyPath->getTime());
        $this->assertEquals($thirdStation->getName(), $onlyPath->getLastVisitedStationName());

        $this->assertEquals(
            [
                $firstStation->getName(),
                $secondStation->getName(),
                $thirdStation->getName()
            ],
            $onlyPath->getPath()->getListOfStationNames()
        );
    }

    /**
     * Test path with one return station connected to starting station
     * Main path: 1 -> 2 -> 3
     * Side path 1 -> 4 -> 1
     * @return void
     */
    public function testTwoPathsWhereSecondOptimalCase(): void
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();

        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);
        $firstStation->addDualConnections($fourthStation, 5);

        $pathCalculator = new PathCalculator($firstStation, $thirdStation);
        $pathCalculator->addFinishCondition(new CountStations(4));

        $pathCalculator->calculate();

        $this->assertCount(1, $pathCalculator->getPaths()->toArray());

        /** @var Path $fastestPath */
        $fastestPath = $pathCalculator->getPaths()->first();

        $this->assertInstanceOf(Path::class, $fastestPath);

        $this->assertEquals(115, $fastestPath->getTime());

        $this->assertEquals(
            [
                $firstStation->getName(),
                $fourthStation->getName(),
                $firstStation->getName(),
                $secondStation->getName(),
                $thirdStation->getName()
            ],
            $fastestPath->getPath()->getListOfStationNames()
        );
    }

    /**
     * Tests case where turn-and-back-connection is taken into consideration,
     * even if it's the second path
     * Main path: 1 -> 2 -> 4 -> 5
     * Side path: 2 -> 3 -> 2
     * @return void
     */
    public function testCaseWithReturnStation(): void
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();
        $fifthStation = new StationFive();

        $firstStation->addDualConnections($secondStation, 15);
        $secondStation->addDualConnections($thirdStation, 20);
        $secondStation->addDualConnections($fourthStation, 25);
        $fourthStation->addDualConnections($fifthStation, 30);

        $pathCalculator = new PathCalculator($firstStation, $fifthStation);
        $pathCalculator->addFinishCondition(new CountStations(5));

        $pathCalculator->calculate();

        $this->assertCount(1, $pathCalculator->getPaths()->toArray());

        /** @var Path $fastestPath */
        $fastestPath = $pathCalculator->getPaths()->first();

        $this->assertInstanceOf(Path::class, $fastestPath);

        $this->assertEquals(110, $fastestPath->getTime());

        $this->assertEquals(
            [
                $firstStation->getName(),
                $secondStation->getName(),
                $thirdStation->getName(),
                $secondStation->getName(),
                $fourthStation->getName(),
                $fifthStation->getName()
            ],
            $fastestPath->getPath()->getListOfStationNames()
        );
    }

    /**
     * Main path: 1 -> 2 -> 3 -> 4
     * Side path 2 -> 5 -> 2
     * Side path 3 -> 6 -> 3
     * Solution path 1 -> 2 -> 5 -> 2 -> 3 -> 6 -> 3 -> 4
     */
    public function testPathWithSingleStationsJoinedAlongTheWay()
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();
        $fifthStation = new StationFive();
        $sixthStation = new StationSix();

        $firstStation->addDualConnections($secondStation, 1);
        $secondStation->addDualConnections($thirdStation, 12);
        $thirdStation->addDualConnections($fourthStation, 5);
        $secondStation->addDualConnections($fifthStation, 11);
        $thirdStation->addDualConnections($sixthStation, 7);

        $pathCalculator = new PathCalculator($firstStation, $fourthStation);
        $pathCalculator->addFinishCondition(new CountStations(6));

        $pathCalculator->calculate();

        $this->assertCount(1, $pathCalculator->getPaths()->toArray());

        /** @var Path $fastestPath */
        $fastestPath = $pathCalculator->getPaths()->first();

        $this->assertInstanceOf(Path::class, $fastestPath);

        $this->assertEquals(54, $fastestPath->getTime());

        $this->assertEquals(
            [
                $firstStation->getName(),
                $secondStation->getName(),
                $fifthStation->getName(),
                $secondStation->getName(),
                $thirdStation->getName(),
                $sixthStation->getName(),
                $thirdStation->getName(),
                $fourthStation->getName(),
            ],
            $fastestPath->getPath()->getListOfStationNames()
        );
    }
}