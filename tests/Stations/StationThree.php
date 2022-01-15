<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationThree extends AbstractSubwayStation
{
    public function getName(): string
    {
        return 'StationThree';
    }
}