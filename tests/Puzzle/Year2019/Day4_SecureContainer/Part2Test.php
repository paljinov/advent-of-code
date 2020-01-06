<?php

namespace Tests\Puzzle\Year2019\Day4_SecureContainer;

use App\Puzzle\Year2019\Day4_SecureContainer\Part2;
use PHPUnit\Framework\TestCase;
use Tests\Puzzle\Year2019\Day4_SecureContainer\Part1Test;

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
            ['112233-112233', 1],
            ['123444-123444', 0],
            ['111122-111122', 1],
            [Part1Test::getPuzzleInput(), 670]
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
