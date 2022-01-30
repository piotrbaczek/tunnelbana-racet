<?php

namespace pbaczek\tunnelbanarace\Stations\AbstractStation;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class ConnectionsList
{
    /** @var ConnectionsCollection $connections */
    private $connections;

    /** @var AbstractStation $station */
    private $station;

    public function __construct(AbstractStation $station)
    {
        $this->connections = new ConnectionsCollection();
        $this->station = $station;
    }

    public function addConnection(AbstractStation $connectingStation, int $timeInMinutes)
    {
        $connection = new Connection($connectingStation, $timeInMinutes);
        $this->connections->add($connection);
    }

    public function getConnections()
    {
        return $this->connections;
    }

    public function __clone()
    {
        $this->connections = clone $this->connections;
    }
}