<?php

namespace Tests\Puzzle\Year2019\Day2_1202ProgramAlarm;

use App\Puzzle\Year2019\Day2_1202ProgramAlarm\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2019\Day2_1202ProgramAlarm\Part1Test;

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
            [Part1Test::getPuzzleInput(), 7960]
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
