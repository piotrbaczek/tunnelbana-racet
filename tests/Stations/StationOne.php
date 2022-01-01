<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class StationOne extends AbstractStation
{
    public function getName(): string
    {
        return 'StationOne';
    }
}