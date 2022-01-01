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
        $path = $this->calculateForConnection($this->baseStation, $this->finishStation, $path);
        var_dump($path);
    }

    private static function calculateForConnection(AbstractStation $currentStation, AbstractStation $finishStation, Path $path): Path
    {
        /** @var Connection $connection */
        foreach ($currentStation->getConnectionsList()->getConnections() as $connection) {
            //We reached final station
            if ($connection->getAbstractStation()->getName() === $finishStation->getName()) {
                $path->addConnection($connection);
                return $path;
            }

            //We have already been here, are we in a loop?
            if ($path->containsStation($connection->getAbstractStation()) === true) {
                continue;
            }

            //Go through this station
            $path = clone $path;
            $path->addConnection($connection);
            self::calculateForConnection($connection->getAbstractStation(), $finishStation, $path);
        }

        return $path;
    }
}