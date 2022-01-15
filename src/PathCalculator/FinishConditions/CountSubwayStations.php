<?php

namespace pbaczek\tunnelbanarace\PathCalculator\FinishConditions;

use pbaczek\tunnelbanarace\Path;

class CountSubwayStations extends AbstractFinishCondition
{
    /**
     * Check if this finish condition is met
     * @param Path $path
     * @return bool
     */
    public function checkCondition(Path $path): bool
    {
        //@TODO
    }
}