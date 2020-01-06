<?php

namespace Tests\Puzzle\Year2017\Day1_InverseCaptcha;

use App\Puzzle\Year2017\Day1_InverseCaptcha\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2017\Day1_InverseCaptcha\Part1Test;

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
            ['1212', 6],
            ['1221', 0],
            ['123425', 4],
            ['123123', 12],
            ['12131415', 4],
            [Part1Test::getPuzzleInput(), 1024]
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
