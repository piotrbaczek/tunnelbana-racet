<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Stations\AbstractStation;
use pbaczek\tunnelbanarace\Stations\AbstractStation\Connection;

class PathCalculator
{
    /** @var AbstractStation $baseStation */
    private $baseStation;

    /** @var $finishStation */
    private $finishStation;

    /** @var PathsCollection $paths */
    private $paths;

    /** @var int $requiredAmountOfStations */
    private $requiredAmountOfStations;

    public function __construct(AbstractStation $baseStation, AbstractStation $finishStation, int $requiredAmountOfStations)
    {
        $this->paths = new PathsCollection();
        $this->baseStation = $baseStation;
        $this->finishStation = $finishStation;
        $this->requiredAmountOfStations = abs($requiredAmountOfStations);
    }

    public function calculate(): void
    {
        $this->paths = $this->calculateForConnection(
            $this->baseStation,
            $this->finishStation,
            new Path($this->baseStation),
            $this->requiredAmountOfStations
        );
        $this->paths = $this->paths->sort('getTime');
    }

    private static function calculateForConnection(
        AbstractStation $currentStation,
        AbstractStation $finishStation,
        Path $path,
        int $requiredAmountOfStations
    ): PathsCollection
    {
        $pathsCollection = new PathsCollection();

        /** @var Connection $connection */
        foreach ($currentStation->getConnectionsList()->getConnections() as $connection) {
            //We reached final station
            if ($connection->getAbstractStation()->getName() === $finishStation->getName()) {
                $nextPath = clone $path;
                $nextPath->addConnection($connection);

                if ($nextPath->getUniqueStationsCount() === $requiredAmountOfStations) {
                    $pathsCollection->add($nextPath);
                    return $pathsCollection;
                }
                continue;
            }

            //We have already been there, are we in a loop?
            $nextStation = $connection->getAbstractStation();
            //This order matters
            if ($currentStation->getConnectionsList()->getConnections()->count() > 1
                && $path->containsStation($nextStation) === true
            ) {
                continue;
            }

            //Go through this station
            $nextPath = clone $path;
            $nextPath->addConnection($connection);
            $subPathCollection = self::calculateForConnection(
                $connection->getAbstractStation(),
                $finishStation,
                $nextPath,
                $requiredAmountOfStations
            );

            if ($subPathCollection->count() === 0) {
                continue;
            }

            if ($pathsCollection->count() > 0) {
                $foundSolutionLength = $pathsCollection->getMinimalPathLength();
                if ($nextPath->getTime() > $foundSolutionLength) {
                    //this solution is already longer than found
                    continue;
                }
            }

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