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
     * @param ConnectionsList $connectionsList
     */
    public function __construct(ConnectionsList $connectionsList)
    {
        $this->connectionsList = $connectionsList;
    }

    abstract public function getName(): string;

    /**
     * @return ConnectionsList
     */
    public function getConnectionsList(): ConnectionsList
    {
        return $this->connectionsList;
    }
}