<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class StationThree extends AbstractStation
{
    public function getName(): string
    {
        return 'StationThree';
    }
}