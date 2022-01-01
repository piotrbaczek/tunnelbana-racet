<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class PathCalculator
{
    /** @var AbstractStation $baseStation */
    private $baseStation;

    /** @var $finishStation */
    private $finishStation;

    public function addBaseStation(AbstractStation $baseStation)
    {
        $this->baseStation = $baseStation;

        return $this;
    }

    public function addFinishStation(AbstractStation $finishStation)
    {
        $this->finishStation = $finishStation;

        return $this;
    }

    public function calculate(): void
    {
        $path = new Path($this->baseStation);
        $this->calculateForConnection($this->baseStation, $path);
        var_dump($path);
    }

    private static function calculateForConnection(AbstractStation $station, Path $path)
    {
        /** @var Connection $connection */
        foreach ($station->getConnectionsList()->getConnections() as $connection) {
            if ($path->containsStation($connection->getAbstractStation()) === true) {
                return;
            }
            $path = clone $path;
            $path->addConnection($connection);
            self::calculateForConnection($connection->getAbstractStation(), $path);
        }

        var_dump($path);
        die();
    }
}