<?php

namespace pbaczek\tunnelbanarace\PathCalculator\FinishConditions;

use pbaczek\tunnelbanarace\Path;

class CountStations extends AbstractFinishCondition
{
    /** @var int $amountRequiredStations */
    private $amountRequiredStations;

    public function __construct(int $amountRequiredStations)
    {
        $this->amountRequiredStations = $amountRequiredStations;
    }

    /**
     * Check if this finish condition is met
     * @param Path $path
     * @return bool
     */
    public function checkCondition(Path $path): bool
    {
        return self::getUniqueStationsCount($path) === $this->amountRequiredStations;
    }

    private static function getUniqueStationsCount(Path $path): int
    {
        return count(array_unique($path->getPath()->getListOfStationNames()));
    }
}