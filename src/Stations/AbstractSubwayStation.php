<?php

namespace pbaczek\tunnelbanarace\Stations;

use pbaczek\tunnelbanarace\Dictionaries\PublicTransportType;

abstract class AbstractSubwayStation extends AbstractStation
{
    public function getType(): string
    {
        return PublicTransportType::SUBWAY;
    }
}