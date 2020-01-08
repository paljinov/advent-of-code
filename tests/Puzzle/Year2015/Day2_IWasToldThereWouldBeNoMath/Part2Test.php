<?php

namespace Tests\Puzzle\Year2015\Day2_IWasToldThereWouldBeNoMath;

use App\Puzzle\Year2015\Day2_IWasToldThereWouldBeNoMath\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2015\Day2_IWasToldThereWouldBeNoMath\Part1Test;

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
                2x3x4
                EOT,
                34
            ],
            [
                <<<'EOT'
                1x1x10
                EOT,
                14
            ],
            [Part1Test::getPuzzleInput(), 3842356]
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
