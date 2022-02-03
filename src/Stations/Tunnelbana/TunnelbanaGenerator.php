<?php

namespace pbaczek\tunnelbanarace\Stations\Tunnelbana;

use pbaczek\tunnelbanarace\Stations\StationsCollection;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Abrahamsberg;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Alvik;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Bagarmossen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Björkhagen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Blackeberg;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Blåsut;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Brommaplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Farsta;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\FarstaStrand;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Fridhemsplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\GamlaStan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Gubbängen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Gullmarsplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Hammarbyhöjden;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\HässelbyGård;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\HässelbyStrand;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Hökarängen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Hötorget;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Islandstorget;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Johannelund;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Kristineberg;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Kärrtorp;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Medborgarplatsen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Odenplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Råcksta;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Rådmansgatan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Sandsborg;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\SanktEriksplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Skanstull;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Skarpnäck;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Skogsyrkogården;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Skärmarbrink;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Slussen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\StoraMossen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Tallkrogen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\TCentralen;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Thorildsplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Vällingby;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Ängbyplan;
use pbaczek\tunnelbanarace\Stations\Tunnelbana\Stations\Åkeshov;

class TunnelbanaGenerator
{
    public function buildStationsCollection(): StationsCollection
    {
        $stationsCollection = new StationsCollection();

        $tcentralen = new TCentralen();
        $stationsCollection->add($tcentralen);

        $this->buildMainGreenLine($stationsCollection);
        $this->buildWestGreenLine($stationsCollection);
        $this->buildEastGreenLine($stationsCollection);

        $this->buildRedLine($stationsCollection);

        $this->buildBlueLine($stationsCollection);

        return $stationsCollection;
    }

    private function buildMainGreenLine(StationsCollection $stationsCollection): void
    {
        /** @var TCentralen $tCentralen */
        $tCentralen = $stationsCollection->where('getName', 'TCentralen')->first();

        $farstaStrand = new FarstaStrand();
        $stationsCollection->add($farstaStrand);
        $farsta = new Farsta();
        $stationsCollection->add($farsta);
        $hokarangen = new Hökarängen();
        $stationsCollection->add($hokarangen);
        $gubbangen = new Gubbängen();
        $stationsCollection->add($gubbangen);
        $tallkrogen = new Tallkrogen();
        $stationsCollection->add($tallkrogen);
        $skogsyrkogarden = new Skogsyrkogården();
        $stationsCollection->add($skogsyrkogarden);
        $sandsborg = new Sandsborg();
        $stationsCollection->add($sandsborg);
        $blasut = new Blåsut();
        $stationsCollection->add($blasut);
        $skarmarbrink = new Skärmarbrink();
        $stationsCollection->add($skarmarbrink);
        $gullmarsplan = new Gullmarsplan();
        $stationsCollection->add($gullmarsplan);
        $skanstull = new Skanstull();
        $stationsCollection->add($skanstull);
        $medborgarplatsen = new Medborgarplatsen();
        $stationsCollection->add($medborgarplatsen);
        $slussen = new Slussen();
        $stationsCollection->add($slussen);
        $gamlaStan = new GamlaStan();
        $stationsCollection->add($gamlaStan);

        $hotorget = new Hötorget();
        $stationsCollection->add($hotorget);
        $radmansgatan = new Rådmansgatan();
        $stationsCollection->add($radmansgatan);
        $odenplan = new Odenplan();
        $stationsCollection->add($odenplan);
        $sanktEriksplan = new SanktEriksplan();
        $stationsCollection->add($sanktEriksplan);
        $fridhemsplan = new Fridhemsplan();
        $stationsCollection->add($fridhemsplan);
        $thorildsplan = new Thorildsplan();
        $stationsCollection->add($thorildsplan);
        $kristineberg = new Kristineberg();
        $stationsCollection->add($kristineberg);
        $alvik = new Alvik();
        $stationsCollection->add($alvik);
        $storaMossen = new StoraMossen();
        $stationsCollection->add($storaMossen);
        $abrahamsberg = new Abrahamsberg();
        $stationsCollection->add($abrahamsberg);
        $brommaplan = new Brommaplan();
        $stationsCollection->add($brommaplan);
        $akeshov = new Åkeshov();
        $stationsCollection->add($akeshov);
        $angbyplan = new Ängbyplan();
        $stationsCollection->add($angbyplan);
        $islandstorget = new Islandstorget();
        $stationsCollection->add($islandstorget);
        $blackeberg = new Blackeberg();
        $stationsCollection->add($blackeberg);
        $racksta = new Råcksta();
        $stationsCollection->add($racksta);
        $vallingby = new Vällingby();
        $stationsCollection->add($vallingby);
        $johannelund = new Johannelund();
        $stationsCollection->add($johannelund);
        $hasselbyGard = new HässelbyGård();
        $stationsCollection->add($hasselbyGard);
        $hasselbyStrand = new HässelbyStrand();
        $stationsCollection->add($hasselbyStrand);

        $farstaStrand->addDualConnections($farsta, 5);
        $farsta->addDualConnections($hokarangen, 5);
        $hokarangen->addDualConnections($gubbangen, 5);
        $gubbangen->addDualConnections($tallkrogen, 5);
        $tallkrogen->addDualConnections($skogsyrkogarden, 5);
        $skogsyrkogarden->addDualConnections($sandsborg, 5);
        $sandsborg->addDualConnections($blasut, 5);
        $blasut->addDualConnections($skarmarbrink, 5);
        $skarmarbrink->addDualConnections($gullmarsplan, 5);
        $gullmarsplan->addDualConnections($skanstull, 5);
        $skanstull->addDualConnections($medborgarplatsen, 5);
        $medborgarplatsen->addDualConnections($slussen, 5);
        $slussen->addDualConnections($gamlaStan, 5);
        $gamlaStan->addDualConnections($tCentralen, 5);
        $tCentralen->addDualConnections($hotorget, 5);
        $hotorget->addDualConnections($radmansgatan, 5);
        $radmansgatan->addDualConnections($odenplan, 5);
        $odenplan->addDualConnections($sanktEriksplan, 5);
        $sanktEriksplan->addDualConnections($fridhemsplan, 5);
        $fridhemsplan->addDualConnections($thorildsplan, 5);
        $thorildsplan->addDualConnections($kristineberg, 5);
        $kristineberg->addDualConnections($alvik, 5);
        $alvik->addDualConnections($storaMossen, 5);
        $storaMossen->addDualConnections($abrahamsberg, 5);
        $abrahamsberg->addDualConnections($brommaplan, 5);
        $brommaplan->addDualConnections($akeshov, 5);
        $akeshov->addDualConnections($angbyplan, 5);
        $angbyplan->addDualConnections($islandstorget, 5);
        $islandstorget->addDualConnections($blackeberg, 5);
        $blackeberg->addDualConnections($racksta, 5);
        $racksta->addDualConnections($vallingby, 5);
        $vallingby->addDualConnections($johannelund, 5);
        $johannelund->addDualConnections($hasselbyGard, 5);
        $hasselbyGard->addDualConnections($hasselbyStrand, 5);
    }

    private function buildWestGreenLine(StationsCollection $stationsCollection): void
    {
        /** @var Skärmarbrink $skarmarbrink */
        $skarmarbrink = $stationsCollection->where('getName', 'Skärmarbrink')->first();

        $skarpnack = new Skarpnäck();
        $stationsCollection->add($skarpnack);
        $bagarmossen = new Bagarmossen();
        $stationsCollection->add($bagarmossen);
        $karrtorp = new Kärrtorp();
        $stationsCollection->add($karrtorp);
        $bjorkhagen = new Björkhagen();
        $stationsCollection->add($bjorkhagen);
        $hammarbyHojden = new Hammarbyhöjden();
        $stationsCollection->add($hammarbyHojden);

        $skarpnack->addDualConnections($bagarmossen, 5);
        $bagarmossen->addDualConnections($karrtorp, 5);
        $karrtorp->addDualConnections($bjorkhagen, 5);
        $bjorkhagen->addDualConnections($hammarbyHojden, 5);
        $hammarbyHojden->addDualConnections($skarmarbrink, 5);
    }

    private function buildEastGreenLine(StationsCollection $stationsCollection): void
    {

    }

    private function buildRedLine(StationsCollection $stationsCollection): void
    {

    }

    private function buildBlueLine(StationsCollection $stationsCollection): void
    {

    }
}