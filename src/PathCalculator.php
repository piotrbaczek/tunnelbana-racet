<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Exceptions\NoFinishConditions;
use pbaczek\tunnelbanarace\PathCalculator\FinishConditions\AbstractFinishCondition;
use pbaczek\tunnelbanarace\PathCalculator\FinishConditions\FinishConditionsCollection;
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

    /** @var FinishConditionsCollection $finishConditions */
    private $finishConditions;

    public function __construct(AbstractStation $baseStation, AbstractStation $finishStation)
    {
        $this->paths = new PathsCollection();
        $this->baseStation = $baseStation;
        $this->finishStation = $finishStation;
        $this->finishConditions = new FinishConditionsCollection();
    }

    /**
     * Add finish condition
     * @param AbstractFinishCondition $finishCondition
     * @return $this
     */
    public function addFinishCondition(AbstractFinishCondition $finishCondition): self
    {
        $this->finishConditions->add($finishCondition);

        return $this;
    }

    public function calculate(): void
    {
        if ($this->finishConditions->count() === 0) {
            throw new NoFinishConditions('At least one finish condition must be provided.');
        }

        $this->paths = $this->calculateForConnection(
            $this->baseStation,
            $this->finishStation,
            new Path($this->baseStation),
            )
            ->sort('getTime');
    }

    private function calculateForConnection(
        AbstractStation $currentStation,
        AbstractStation $finishStation,
        Path $path
    ): PathsCollection
    {
        $pathsCollection = new PathsCollection();

        /** @var Connection $connection */
        foreach ($currentStation->getConnectionsList()->getConnections() as $connection) {
            //We reached final station

            $currentPath = clone $path;

            if ($connection->getAbstractStation()->getName() === $finishStation->getName()) {
                $nextPath = clone $currentPath;
                $nextPath->addConnection($connection);

                if ($this->checkFinishCondition($nextPath) === true) {
                    $pathsCollection->add($nextPath);

                    return $pathsCollection;
                }

                continue;
            }

            //We have already been there, are we in a loop?
            $nextStation = $connection->getAbstractStation();
            //This order matters
            if ($currentStation->getConnectionsList()->getConnections()->count() > 1
                && $currentPath->containsStation($nextStation) === true
            ) {
                continue;
            }

            //Go through this station
            $nextPath = clone $currentPath;
            $nextPath->addConnection($connection);
            $subPathCollection = self::calculateForConnection(
                $connection->getAbstractStation(),
                $finishStation,
                $nextPath
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
     * Checks if finishing conditions has been met
     * @param Path $nextPath
     * @return bool
     */
    private function checkFinishCondition(Path $nextPath): bool
    {
        /** @var AbstractFinishCondition $finishCondition */
        foreach ($this->finishConditions as $finishCondition) {
            if ($finishCondition->checkCondition($nextPath) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return PathsCollection
     */
    public function getPaths(): PathsCollection
    {
        return $this->paths;
    }
}