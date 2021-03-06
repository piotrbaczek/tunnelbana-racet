<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;
use pbaczek\tunnelbanarace\Stations\AbstractStation\Connection;

class Path
{
    private $path = [];
    private $time = 0;

    public function __construct(AbstractStation $baseStation)
    {
        $this->path[] = $baseStation->getName();
    }

    public function addConnection(Connection $connection)
    {
        $this->path[] = $connection->getAbstractStation()->getName();
        $this->time += $connection->getTimeInMinutes();
    }

    public function containsStation(AbstractStation $station): bool
    {
        return in_array($station->getName(), $this->path) === true;
    }

    public function getLastVisitedStationName(): ?string
    {
        return end($this->path);
    }

    public function getUniqueStationsCount(): int
    {
        return count(array_unique($this->path));
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }
}