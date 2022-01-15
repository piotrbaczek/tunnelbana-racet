<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationSix extends AbstractSubwayStation
{
    /**
     * Get name of the station
     * @return string
     */
    public function getName(): string
    {
        return 'StationSix';
    }
}