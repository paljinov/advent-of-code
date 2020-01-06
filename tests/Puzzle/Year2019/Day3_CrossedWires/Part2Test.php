<?php

namespace Tests\Puzzle\Year2019\Day3_CrossedWires;

use App\Puzzle\Year2019\Day3_CrossedWires\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2019\Day3_CrossedWires\Part1Test;

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
                R8,U5,L5,D3
                U7,R6,D4,L4
                EOT,
                30
            ],
            [
                <<<'EOT'
                R75,D30,R83,U83,L12,D49,R71,U7,L72
                U62,R66,U55,R34,D71,R55,D58,R83
                EOT,
                610
            ],
            [
                <<<'EOT'
                R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
                U98,R91,D20,R16,D67,R40,U7,R15,U6,R7
                EOT,
                410
            ],
            [Part1Test::getPuzzleInput(), 107754]
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
