<?php

namespace Tests\Puzzle\Year2017\Day2_CorruptionChecksum;

use App\Puzzle\Year2017\Day2_CorruptionChecksum\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2017\Day2_CorruptionChecksum\Part1Test;

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
                5 9 2 8
                9 4 7 3
                3 8 6 5
                EOT,
                9
            ],
            [Part1Test::getPuzzleInput(), 263]
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
