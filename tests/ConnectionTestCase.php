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
        $pathCalculator = new PathCalculator();

        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();

        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);

        $pathCalculator
            ->addBaseStation($firstStation)
            ->addFinishStation($thirdStation);

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
        $pathCalculator = new PathCalculator();

        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();

        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);
        $firstStation->addDualConnections($fourthStation, 5);
        $fourthStation->addDualConnections($thirdStation, 10);

        $pathCalculator
            ->addBaseStation($firstStation)
            ->addFinishStation($thirdStation);

        $pathCalculator->calculate();

        $this->assertCount(2, $pathCalculator->getPaths()->toArray());

        /** @var Path $fastestPath */
        $fastestPath = $pathCalculator->getPaths()->first();

        $this->assertInstanceOf(Path::class, $fastestPath);

        $this->assertEquals(15, $fastestPath->getTime());

        $this->assertEquals([$firstStation->getName(), $fourthStation->getName(), $thirdStation->getName()], $fastestPath->getPath());

        /** @var Path $nextFastest */
        $nextFastest = $pathCalculator->getPaths()->last();
        $this->assertInstanceOf(Path::class, $nextFastest);

        $this->assertEquals(105, $nextFastest->getTime());
        $this->assertEquals($thirdStation->getName(), $nextFastest->getLastVisitedStationName());

        $this->assertEquals([$firstStation->getName(), $secondStation->getName(), $thirdStation->getName()], $nextFastest->getPath());
    }

    /**
     * Tests that second path gets cut off if length gets greater than currently found
     * @return void
     */
    public function testTwoPathsWhereFirstOptimalCase(): void
    {
        $pathCalculator = new PathCalculator();

        $firstStation = new StationOne();
        $secondStation = new StationTwo();
        $thirdStation = new StationThree();
        $fourthStation = new StationFour();

        $firstStation->addDualConnections($fourthStation, 5);
        $fourthStation->addDualConnections($thirdStation, 10);
        $firstStation->addDualConnections($secondStation, 60);
        $secondStation->addDualConnections($thirdStation, 45);

        $pathCalculator
            ->addBaseStation($firstStation)
            ->addFinishStation($thirdStation);

        $pathCalculator->calculate();

        $this->assertCount(1, $pathCalculator->getPaths()->toArray());

        /** @var Path $fastestPath */
        $fastestPath = $pathCalculator->getPaths()->first();

        $this->assertInstanceOf(Path::class, $fastestPath);

        $this->assertEquals(15, $fastestPath->getTime());

        $this->assertEquals([$firstStation->getName(), $fourthStation->getName(), $thirdStation->getName()], $fastestPath->getPath());
    }
}