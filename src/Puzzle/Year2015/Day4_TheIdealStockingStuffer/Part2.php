<?php

/*
--- Part Two ---

Now find one that starts with six zeroes.
*/

namespace App\Puzzle\Year2015\Day4_TheIdealStockingStuffer;

use App\Puzzle\PuzzleInterface;

class Part2 implements PuzzleInterface
{
    /**
     * Part 1.
     *
     * @var Part1
     */
    private $part1;

    public function __construct()
    {
        // Needed function(s) are already implemented in part1
        $this->part1 = new Part1();
    }

    /**
     * Finds lowest positive number that produces hash (no leading zeroes:
     * 1, 2, 3, ...), which, in hexadecimal, starts with at least six zeroes.
     *
     * @param string $secretKey
     *
     * @return integer
     */
    public function solution($secretKey)
    {
        $number = $this->part1->findMd5SuffixInputNumber($secretKey, 6);
        return $number;
    }
}
