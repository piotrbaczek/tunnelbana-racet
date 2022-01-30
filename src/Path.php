<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;
use pbaczek\tunnelbanarace\Stations\AbstractStation\Connection;
use pbaczek\tunnelbanarace\Stations\StationsCollection;

class Path
{
    /** @var StationsCollection|AbstractStation[] $path */
    private $path;

    /** @var int $time */
    private $time = 0;

    public function __construct(AbstractStation $baseStation)
    {
        $clonedBaseStation = clone $baseStation;
        $clonedBaseStation->getConnectionsList()->getConnections()->clear();

        $this->path = new StationsCollection([$clonedBaseStation]);
    }

    public function addConnection(Connection $connection)
    {
        $clonedStation = clone $connection->getAbstractStation();
        $clonedStation->getConnectionsList()->getConnections()->clear();

        $this->path->add($clonedStation);
        $this->time += $connection->getTimeInMinutes();
    }

    /**
     * Checks if path contains station by Station name.
     * Returns true if it does, false if it doesn't
     * @param AbstractStation $station
     * @return bool
     */
    public function containsStation(AbstractStation $station): bool
    {
        foreach ($this->path as $stationInPath) {
            if ($station->getName() === $stationInPath->getName()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return StationsCollection
     */
    public function getPath(): StationsCollection
    {
        return $this->path;
    }

    public function __clone()
    {
        $this->path = clone $this->path;
    }
}