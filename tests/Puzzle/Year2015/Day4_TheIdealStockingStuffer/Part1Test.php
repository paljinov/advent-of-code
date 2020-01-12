<?php

namespace Tests\Puzzle\Year2015\Day4_TheIdealStockingStuffer;

use App\Puzzle\Year2015\Day4_TheIdealStockingStuffer\Part1;
use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    private const PUZZLE_INPUT = 'iwrupvqb';

    /**
     * Part 1.
     *
     * @var Part1
     */
    private $part1;

    public static function getPuzzleInput(): string
    {
        return self::PUZZLE_INPUT;
    }

    public function inputOutputProvider(): array
    {
        return [
            ['abcdef', 609043],
            ['pqrstuv', 1048970],
            [self::getPuzzleInput(), 346386]
        ];
    }

    /**
     * @dataProvider inputOutputProvider
     */
    public function testSolution(string $input, int $output): void
    {
        $this->assertEquals($output, $this->part1->solution($input));
    }

    protected function setUp(): void
    {
        $this->part1 = new Part1();
    }
}
