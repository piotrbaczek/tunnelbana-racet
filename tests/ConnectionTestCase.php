<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Path;
use pbaczek\tunnelbanarace\PathCalculator;
use PHPUnit\Framework\TestCase;

final class ConnectionTestCase extends TestCase
{
    /**
     * Tests that in linear case we can find the final station
     * @return void
     */
    public function testBasicStationsTask(): void
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();

        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);

        $pathCalculator = new PathCalculator($firstStation, $thirdStation, 3);

        $pathCalculator->calculate();

        /** @var Path $onlyPath */
        $onlyPath = $pathCalculator->getPaths()->first();
        $this->assertInstanceOf(Path::class, $onlyPath);

        $this->assertEquals(105, $onlyPath->getTime());
        $this->assertEquals($thirdStation->getName(), $onlyPath->getLastVisitedStationName());

        $this->assertEquals([$firstStation->getName(), $secondStation->getName(), $thirdStation->getName()], $onlyPath->getPath());
    }

    /**
     * Test two paths one of which is faster
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

        $pathCalculator = new PathCalculator($firstStation, $thirdStation, 4);

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
            $fastestPath->getPath()
        );
    }

    /**
     * Tests that turn-and-back connection is taken into consideration
     * @return void
     */
    public function testTwoPathsWhereFirstOptimalCase(): void
    {
        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();

        $firstStation->addDualConnections($fourthStation, 5);
        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);

        $pathCalculator = new PathCalculator($firstStation, $thirdStation, 4);

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
            $fastestPath->getPath()
        );
    }

    /**
     * Tests case where turn-and-back-connection is taken into consideration,
     * even if it's the second path
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

        $pathCalculator = new PathCalculator($firstStation, $fifthStation, 5);
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
            $fastestPath->getPath()
        );
    }
}