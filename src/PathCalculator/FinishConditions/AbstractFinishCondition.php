<?php

namespace pbaczek\tunnelbanarace\PathCalculator\FinishConditions;

use pbaczek\tunnelbanarace\Path;

abstract class AbstractFinishCondition
{
    /**
     * Check if this finish condition is met
     * @param Path $path
     * @return bool
     */
    abstract public function checkCondition(Path $path): bool;
}