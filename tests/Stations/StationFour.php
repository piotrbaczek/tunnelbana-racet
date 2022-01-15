<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationFour extends AbstractSubwayStation
{
    public function getName(): string
    {
        return 'StationFour';
    }
}