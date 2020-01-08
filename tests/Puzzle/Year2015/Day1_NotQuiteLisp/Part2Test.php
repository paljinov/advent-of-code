<?php

namespace Tests\Puzzle\Year2015\Day1_NotQuiteLisp;

use App\Puzzle\Year2015\Day1_NotQuiteLisp\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day1_NotQuiteLisp\Part1Test;

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
            [')', 1],
            ['()())', 5],
            [Part1Test::getPuzzleInput(), 1771]
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
