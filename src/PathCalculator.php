<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;

class PathCalculator
{
    /** @var AbstractStation $baseStation */
    private $baseStation;

    /** @var $finishStation */
    private $finishStation;

    /** @var PathsCollection $paths */
    private $paths;

    public function __construct()
    {
        $this->paths = new PathsCollection();
    }

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
        $this->paths = $this->calculateForConnection($this->baseStation, $this->finishStation, $path);
        $this->paths = $this->paths->sort('getTime');
    }

    private static function calculateForConnection(AbstractStation $currentStation, AbstractStation $finishStation, Path $path): PathsCollection
    {
        $pathsCollection = new PathsCollection();

        /** @var Connection $connection */
        foreach ($currentStation->getConnectionsList()->getConnections() as $connection) {
            //We reached final station
            if ($connection->getAbstractStation()->getName() === $finishStation->getName()) {
                $nextPath = clone $path;
                $nextPath->addConnection($connection);
                $pathsCollection->add($nextPath);
                return $pathsCollection;
            }

            //We have already been here, are we in a loop?
            if ($path->containsStation($connection->getAbstractStation()) === true) {
                continue;
            }

            //Go through this station
            $nextPath = clone $path;
            $nextPath->addConnection($connection);
            $subPathCollection = self::calculateForConnection($connection->getAbstractStation(), $finishStation, $nextPath);
            $pathsCollection = $pathsCollection->merge($subPathCollection);
        }

        return $pathsCollection;
    }

    /**
     * @return PathsCollection
     */
    public function getPaths(): PathsCollection
    {
        return $this->paths;
    }
}