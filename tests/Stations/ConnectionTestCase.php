<?php

namespace pbaczek\tunnelbanarace\tests\Stations;

use DI\Container;
use pbaczek\tunnelbanarace\MathHelper;
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
     * Test that we can calculate permutations
     * @return void
     */
    public function testPermutations(): void
    {
        $stations = ['Farsta Strand', 'Farsta', 'Årsta', 'Hökarängen'];

        $perms = MathHelper::permutations($stations);
        $permissions = iterator_to_array($perms);
        $this->assertCount(24, $permissions);
    }

    /**
     * Tests factorials are correct
     * @return void
     */
    public function testFactorial(): void
    {
        $fiveFactorial = MathHelper::factorial(5);
        $this->assertEquals(120, $fiveFactorial);

        $zeroFactorial = MathHelper::factorial(0);
        $this->assertEquals(1, $zeroFactorial);
    }
}