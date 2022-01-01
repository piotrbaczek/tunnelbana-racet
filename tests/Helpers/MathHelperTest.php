<?php

namespace pbaczek\tunnelbanarace\tests\Helpers;

use pbaczek\tunnelbanarace\Helpers\MathHelper;
use PHPUnit\Framework\TestCase;

class MathHelperTest extends TestCase
{
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