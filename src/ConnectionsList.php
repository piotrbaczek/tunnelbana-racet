<?php

namespace pbaczek\tunnelbanarace;

use Ramsey\Collection\AbstractCollection;

class ConnectionsList extends AbstractCollection
{
    /**
     * Returns the type associated with this collection.
     */
    public function getType(): string
    {
        return Connection::class;
    }
}