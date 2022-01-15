<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationTwo extends AbstractSubwayStation
{
    public function getName(): string
    {
        return 'StationTwo';
    }
}