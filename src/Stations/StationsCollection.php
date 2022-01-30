<?php

namespace pbaczek\tunnelbanarace\Stations;

use Ramsey\Collection\AbstractCollection;

class StationsCollection extends AbstractCollection
{
    /**
     * Returns the type associated with this collection.
     */
    public function getType(): string
    {
        return AbstractStation::class;
    }

    /**
     * Get list of stations
     * @return string[]
     */
    public function getListOfStationNames(): array
    {
        return $this->column('getName');
    }
}