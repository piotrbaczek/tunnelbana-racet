<?php

namespace pbaczek\tunnelbanarace\Stations\Tunnelbana;

use pbaczek\tunnelbanarace\Stations\StationsCollection;

class TunnelbanaGenerator
{
    public function buildStationsCollection(): StationsCollection
    {
        $stationsCollection = new StationsCollection();


        return $stationsCollection;
    }
}