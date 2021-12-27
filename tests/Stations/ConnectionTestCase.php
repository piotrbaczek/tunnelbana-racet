<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use pbaczek\tunnelbanarace\Connection;
use PHPUnit\Framework\TestCase;

final class ConnectionTestCase extends TestCase
{
    /** @var Container $di */
    private $di;

    public function setUp()
    {
        parent::setUp();
        $this->di = new Container();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function testBasicAlgorithm()
    {
        $firstStation = new class extends Connection{

        };
    }
}