<?php

namespace pbaczek\tunnelbanarace;

use Generator;

abstract class MathHelper
{
    /**
     * Permutes around array
     * @param array $elements
     * @return Generator
     */
    public static function permutations(array $elements): Generator
    {
        if (count($elements) <= 1) {
            yield $elements;
        } else {
            foreach (self::permutations(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    /**
     * Return factorial of an int
     * @param int $n
     * @return int
     */
    public static function factorial(int $n)
    {
        return (int)gmp_fact(abs($n));
    }
}