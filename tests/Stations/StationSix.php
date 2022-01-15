<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class StationSix extends AbstractStation
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