<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationOne extends AbstractSubwayStation
{
    public function getName(): string
    {
        return 'StationOne';
    }
}