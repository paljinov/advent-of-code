<?php

namespace Tests\Puzzle\Year2015\Day6_ProbablyAFireHazard;

use App\Puzzle\Year2015\Day6_ProbablyAFireHazard\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day6_ProbablyAFireHazard\Part1Test;

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
            [
                <<<'EOT'
                turn on 0,0 through 999,999
                toggle 0,0 through 999,0
                turn off 499,499 through 500,500
                EOT,
                1001996
            ],
            [Part1Test::getPuzzleInput(), 14687245]
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
