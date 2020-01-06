<?php

namespace Tests\Puzzle\Year2019\Day1_TheTyrannyOfTheRocketEquation;

use App\Puzzle\Year2019\Day1_TheTyrannyOfTheRocketEquation\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2019\Day1_TheTyrannyOfTheRocketEquation\Part1Test;

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
            ['14', 2],
            ['1969', 966],
            ['100756', 50346],
            [Part1Test::getPuzzleInput(), 4970206]
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
