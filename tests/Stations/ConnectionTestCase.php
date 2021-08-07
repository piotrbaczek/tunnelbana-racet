<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use pbaczek\tunnelbanarace\Stations\Skanstull;
use pbaczek\tunnelbanarace\Stations\TCentralen;
use PHPUnit\Framework\TestCase;

final class ConnectionTestCase extends TestCase
{
    /** @var Container $di */
    private $di;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->di = new Container();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function testConnecting()
    {
        /** @var Skanstull $skanstull */
        $skanstull = $this->di->make(Skanstull::class);
        $this->assertInstanceOf(Skanstull::class, $skanstull);

        /** @var TCentralen $tCentralen */
        $tCentralen = $this->di->make(TCentralen::class);
        $this->assertInstanceOf(TCentralen::class, $tCentralen);
    }
}