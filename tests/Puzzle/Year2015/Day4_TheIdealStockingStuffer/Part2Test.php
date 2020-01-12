<?php

namespace Tests\Puzzle\Year2015\Day4_TheIdealStockingStuffer;

use App\Puzzle\Year2015\Day4_TheIdealStockingStuffer\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day4_TheIdealStockingStuffer\Part1Test;

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
            [Part1Test::getPuzzleInput(), 9958218]
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
