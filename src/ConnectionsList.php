<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class ConnectionsList
{
    /** @var Connection[] */
    private $connections = [];

    /**
     * @param AbstractStation $abstractStation
     * @param int $timeInMinutes
     * @return $this
     */
    public function connectsTo(AbstractStation $abstractStation, int $timeInMinutes): self
    {
        $this->connections[] = new Connection($abstractStation, $timeInMinutes);

        return $this;
    }

    /**
     * Get connection by name
     * @param string $name
     * @return Connection|null
     */
    public function getConnectionByName(string $name): ?Connection
    {
        foreach ($this->connections as $connection) {
            if ($connection->getAbstractStation()->getName() === $name) {
                return $connection;
            }
        }

        return null;
    }

    public function getConnections()
    {
        return $this->connections;
    }
}