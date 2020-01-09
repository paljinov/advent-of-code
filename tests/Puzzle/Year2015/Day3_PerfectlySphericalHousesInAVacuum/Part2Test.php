<?php

namespace Tests\Puzzle\Year2015\Day3_PerfectlySphericalHousesInAVacuum;

use App\Puzzle\Year2015\Day3_PerfectlySphericalHousesInAVacuum\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day3_PerfectlySphericalHousesInAVacuum\Part1Test;

class Part2Test extends TestCase
{
    /**
     * Part 2.
     *
     * @var Part2
     */
    private $part2;

    public function inputOutputProvider(): array
    {
        return [
            ['^v', 3],
            ['^>v<', 3],
            ['^v^v^v^v^v', 11],
            [Part1Test::getPuzzleInput(), 2360]
        ];
    }

    /**
     * @dataProvider inputOutputProvider
     */
    public function testSolution(string $input, int $output): void
    {
        $this->assertEquals($output, $this->part2->solution($input));
    }

    protected function setUp(): void
    {
        $this->part2 = new Part2();
    }
}
