<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractSubwayStation;

class StationFive extends AbstractSubwayStation
{
    /**
     * Get name of the station
     * @return string
     */
    public function getName(): string
    {
        return 'StationFive';
    }
}