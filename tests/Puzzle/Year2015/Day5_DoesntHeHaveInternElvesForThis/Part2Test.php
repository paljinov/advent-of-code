<?php

namespace Tests\Puzzle\Year2015\Day5_DoesntHeHaveInternElvesForThis;

use App\Puzzle\Year2015\Day5_DoesntHeHaveInternElvesForThis\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day5_DoesntHeHaveInternElvesForThis\Part1Test;

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
                qjhvhtzxzqqjkmpb
                EOT,
                1
            ],
            [
                <<<'EOT'
                xxyxx
                EOT,
                1
            ],
            [
                <<<'EOT'
                uurcxstgmygtbstg
                EOT,
                0
            ],
            [
                <<<'EOT'
                ieodomkazucvgmuy
                EOT,
                0
            ],
            [Part1Test::getPuzzleInput(), 69]
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
