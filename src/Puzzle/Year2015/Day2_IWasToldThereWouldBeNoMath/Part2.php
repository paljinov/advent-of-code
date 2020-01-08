<?php

/*
--- Part Two ---

The elves are also running low on ribbon. Ribbon is all the same width, so they
only have to worry about the length they need to order, which they would again
like to be exact.

The ribbon required to wrap a present is the shortest distance around its sides,
or the smallest perimeter of any one face. Each present also requires a bow made
out of ribbon as well; the feet of ribbon required for the perfect bow is equal
to the cubic feet of volume of the present. Don't ask how they tie the bow,
though; they'll never tell.

For example:

- A present with dimensions 2x3x4 requires 2+2+3+3 = 10 feet of ribbon to wrap
  the present plus 2*3*4 = 24 feet of ribbon for the bow, for a total of 34
  feet.
- A present with dimensions 1x1x10 requires 1+1+1+1 = 4 feet of ribbon to wrap
  the present plus 1*1*10 = 10 feet of ribbon for the bow, for a total of 14
  feet.

How many total feet of ribbon should they order?
*/

namespace App\Puzzle\Year2015\Day2_IWasToldThereWouldBeNoMath;

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
     * Finds how many total feet of ribbon should elves order.
     *
     * @param string $presentsDimensionsMultilineString
     *
     * @return int Total feet of ribbon
     */
    public function solution($presentsDimensionsMultilineString)
    {
        $totalRibbonFeet = 0;

        $presentsDimensions = $this->part1->parsePresentsDimensionsMultilineString($presentsDimensionsMultilineString);
        foreach ($presentsDimensions as $presentsDimension) {
            $length = $presentsDimension[0];
            $width = $presentsDimension[1];
            $height = $presentsDimension[2];

            $ribbonFeet = $this->calculateRibbonFeet($length, $width, $height);
            $totalRibbonFeet += $ribbonFeet;
        }

        return $totalRibbonFeet;
    }

    /**
     * Calculate bow feet.
     *
     * @param integer $length
     * @param integer $width
     * @param integer $height
     *
     * @return integer
     */
    private function calculateBowFeet(int $length, int $width, int $height): int
    {
        $bow = $length * $width * $height;
        return $bow;
    }

    /**
     * Calculate ribbon feet.
     *
     * @param integer $length
     * @param integer $width
     * @param integer $height
     *
     * @return integer
     */
    private function calculateRibbonFeet(int $length, int $width, int $height): int
    {
        $bowFeet = $this->calculateBowFeet($length, $width, $height);

        $sidesLenghts = [$length, $width, $height];
        $maxSideLengthIndex = array_keys($sidesLenghts, max($sidesLenghts))[0];
        unset($sidesLenghts[$maxSideLengthIndex]);

        $smallerSidesLenghts = array_values($sidesLenghts);

        $ribbonFeet = 2 * $smallerSidesLenghts[0] + 2 * $smallerSidesLenghts[1] + $bowFeet;

        return $ribbonFeet;
    }
}
