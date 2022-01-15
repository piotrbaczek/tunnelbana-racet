<?php

namespace pbaczek\tunnelbanarace\PathCalculator\FinishConditions;

use Ramsey\Collection\AbstractCollection;

class FinishConditionsCollection extends AbstractCollection
{
    /**
     * Returns the type associated with this collection.
     */
    public function getType(): string
    {
        return AbstractFinishCondition::class;
    }
}