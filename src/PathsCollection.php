<?php

namespace pbaczek\tunnelbanarace;

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
}