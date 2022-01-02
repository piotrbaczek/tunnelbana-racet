<?php

namespace pbaczek\tunnelbanarace\tests;

use PHPUnit\Framework\TestCase;

/**
 * Class TcpSolutionTest
 * @package pbaczek\tunnelbanarace\tests
 * @see https://blogs.oracle.com/javamagazine/post/how-to-solve-the-classic-traveling-salesman-problem-in-java
 */
class TcpSolutionTest extends TestCase
{
    public function testBasicLogic()
    {
        $this->markTestSkipped('tmp skipped');
        function permutations($items, &$result, $permutations = [])
        {
            if (empty($items)) {
                $result[] = $permutations;
            } else {
                for ($i = count($items) - 1; $i >= 0; $i--) {
                    $newItems = $items;
                    $newPermutations = $permutations;
                    list($temp) = array_splice($newItems, $i, 1);
                    array_unshift($newPermutations, $temp);
                    permutations($newItems, $result, $newPermutations);
                }
            }
        }

        function out($text, $suppressEol = FALSE) {
//        self::init();
        if (is_string($text)) {
            echo $text.($suppressEol ? '' : PHP_EOL);
        } elseif (is_object($text) && method_exists($text, '__toString')) {
            echo $text.($suppressEol ? '' : PHP_EOL);
        } else {
            print_r($text);
            echo $suppressEol ? '' : PHP_EOL;
        }
    }

        $cityPermutations = null;

        $vtDistances = [
            'Rutland' => [
                'Burlington' => 67,
                'White River Junction' => 46,
                'Bennington' => 55,
                'Brattleboro' => 75
            ],
            'Burlington' => [
                'Rutland' => 67,
                'White River Junction' => 91,
                'Bennington' => 122,
                'Brattleboro' => 153
            ],
            'White River Junction' => [
                'Rutland' => 46,
                'Burlington' => 91,
                'Bennington' => 98,
                'Brattleboro' => 65
            ],
            'Bennington' => [
                'Rutland' => 55,
                'Burlington' => 122,
                'White River Junction' => 98,
                'Brattleboro' => 40
            ],
            'Brattleboro' => [
                'Rutland' => 75,
                'Burlington' => 153,
                'White River Junction' => 65,
                'Bennington' => 40
            ]
        ];

        $vtCities = array_keys($vtDistances);
        permutations($vtCities, $cityPermutations);
        $tspPaths = array_map(
            function ($path) {
                return array_merge($path, [$path[0]]);
            },
            $cityPermutations
        );

        $bestPath = [];
        $minDistance = 99999999; // arbitrarily high number
        foreach ($tspPaths as $path) {
            $distance = 0;
            $last = $path[0];
            foreach (array_slice($path, 1) as $next) {
                $distance += $vtDistances[$last][$next];
                $last = $next;
            }
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $bestPath = $path;
            }
        }
        out("The shortest path is:");
        out($bestPath);
        out("in $minDistance miles.");
    }
}