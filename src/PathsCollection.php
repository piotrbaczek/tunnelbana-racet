<?php

namespace pbaczek\tunnelbanarace;

use pbaczek\tunnelbanarace\Exceptions\MinimalPathForEmptyPathList;
use Ramsey\Collection\AbstractCollection;

class PathsCollection extends AbstractCollection
{
    /**
     * Returns the type associated with this collection.
     */
    public function getType(): string
    {
        return Path::class;
    }

    /**
     * @return int
     */
    public function getMinimalPathLength(): int
    {
        if ($this->count() === 0) {
            throw new MinimalPathForEmptyPathList();
        }

        /** @var Path $lowestPath */
        $lowestPath = $this->sort('getTime()', AbstractCollection::SORT_ASC)->first();

        return $lowestPath->getTime();
    }
}