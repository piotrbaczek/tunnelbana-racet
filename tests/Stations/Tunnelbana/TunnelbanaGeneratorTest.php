<?php

namespace pbaczek\tunnelbanarace\tests\Stations\Tunnelbana;

use pbaczek\tunnelbanarace\Path;
use pbaczek\tunnelbanarace\PathCalculator;
use pbaczek\tunnelbanarace\PathCalculator\FinishConditions\CountStations;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\FarstaStrand;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\HässelbyStrand;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\TunnelbanaGenerator;
use PHPUnit\Framework\TestCase;

class TunnelbanaGeneratorTest extends TestCase
{
    /**
     * Test correct path generation
     */
    public function testGeneration(): void
    {
        $this->markTestSkipped('In progress');
        $tunnelbanaGenerator = new TunnelbanaGenerator();
        $stations = $tunnelbanaGenerator->buildStationsCollection();

        /** @var FarstaStrand $farstaStrand */
        $farstaStrand = $stations->where('getName', 'FarstaStrand')->first();

        /** @var HässelbyStrand $hasselbyStrand */
        $hasselbyStrand = $stations->where('getName', 'HässelbyStrand')->first();

        $pathCalculator = new PathCalculator($farstaStrand, $hasselbyStrand);
        $pathCalculator->addFinishCondition(new CountStations($stations->count()));

        $pathCalculator->calculate();

        /** @var Path $path */
        $path = $pathCalculator->getPaths();

        var_dump($path);

        //$this->assertCount(35, $path->getPath()->getListOfStationNames());
    }
}