<?php

namespace Tests\Puzzle\Year2019\Day4_SecureContainer;

use App\Puzzle\Year2019\Day4_SecureContainer\Part1;
use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    private const PUZZLE_INPUT_MULTI_LINE = <<<'EOT'
        254032-789860
        EOT;

    /**
     * Part 1.
     *
     * @var Part1
     */
    private $part1;

    public static function getPuzzleInput(): string
    {
        return self::PUZZLE_INPUT_MULTI_LINE;
    }

    public function inputOutputProvider(): array
    {
        return [
            ['111111-111111', 1],
            ['223450-223450', 0],
            ['123789-123789', 0],
            [self::getPuzzleInput(), 1033]
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
