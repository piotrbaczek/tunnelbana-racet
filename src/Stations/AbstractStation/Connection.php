<?php

namespace pbaczek\tunnelbanarace\Stations\AbstractStation;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

/**
 * Class Connection
 * @package pbaczek\tunnelbanarace
 */
class Connection
{
    /** @var AbstractStation $abstractStation */
    private $abstractStation;

    /** @var int $timeInMinutes */
    private $timeInMinutes;

    /**
     * Connection constructor.
     * @param AbstractStation $abstractStation
     * @param int $timeInMinutes
     */
    public function __construct(AbstractStation $abstractStation, int $timeInMinutes)
    {
        $this->abstractStation = $abstractStation;
        $this->timeInMinutes = $timeInMinutes;
    }

    /**
     * @return AbstractStation
     */
    public function getAbstractStation(): AbstractStation
    {
        return $this->abstractStation;
    }

    /**
     * @return int
     */
    public function getTimeInMinutes(): int
    {
        return $this->timeInMinutes;
    }
}