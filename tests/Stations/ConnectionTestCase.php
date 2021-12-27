<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use DI\Container;
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
}