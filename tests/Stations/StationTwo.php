<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class StationTwo extends AbstractStation
{
    public function getName(): string
    {
        return 'StationTwo';
    }
}