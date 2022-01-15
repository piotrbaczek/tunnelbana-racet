<?php

namespace pbaczek\tunnelbanarace\Stations\AbstractStation;

use Ramsey\Collection\AbstractCollection;

class ConnectionsCollection extends AbstractCollection
{
    /**
     * Returns the type associated with this collection.
     */
    public function getType(): string
    {
        return Connection::class;
    }
}