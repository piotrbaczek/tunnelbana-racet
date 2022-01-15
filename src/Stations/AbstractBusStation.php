<?php

namespace pbaczek\tunnelbanarace\Stations;

use pbaczek\tunnelbanarace\Dictionaries\PublicTransportType;

abstract class AbstractBusStation extends AbstractStation
{
    public function getType(): string
    {
        return PublicTransportType::BUS;
    }
}