<?php

namespace pbaczek\tunnelbanarace\Stations;

use pbaczek\tunnelbanarace\ConnectionsList;

/**
 * Class AbstractStation
 * @package pbaczek\tunnelbanarace\stations
 */
abstract class AbstractStation
{
    /** @var ConnectionsList $connectionsList */
    private $connectionsList;

    /**
     * AbstractStation constructor.
     */
    public function __construct()
    {
        $this->connectionsList = new ConnectionsList($this);
    }

    abstract public function getName(): string;

    public function addDualConnections(AbstractStation $secondStation, int $timeInMinutes)
    {
        $timeInMinutes = abs($timeInMinutes);
        $this->connectionsList->addConnection($secondStation, $timeInMinutes);
        $secondStation->connectionsList->addConnection($this, $timeInMinutes);
    }

    /**
     * @return ConnectionsList
     */
    public function getConnectionsList(): ConnectionsList
    {
        return $this->connectionsList;
    }
}