<?php

namespace pbaczek\tunnelbanarace\Stations;

use pbaczek\tunnelbanarace\Dictionaries\PublicTransportType;

abstract class AbstractTrainStation extends AbstractStation
{
    public function getType(): string
    {
        return PublicTransportType::TRAIN;
    }
}