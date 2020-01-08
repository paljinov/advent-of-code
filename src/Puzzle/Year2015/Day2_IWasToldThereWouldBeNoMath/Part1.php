<?php

/*
--- Day 2: I Was Told There Would Be No Math ---

The elves are running low on wrapping paper, and so they need to submit an order
for more. They have a list of the dimensions (length l, width w, and height h)
of each present, and only want to order exactly as much as they need.

Fortunately, every present is a box (a perfect right rectangular prism), which
makes calculating the required wrapping paper for each gift a little easier:
find the surface area of the box, which is 2*l*w + 2*w*h + 2*h*l. The elves also
need a little extra paper for each present: the area of the smallest side.

For example:

- A present with dimensions 2x3x4 requires 2*6 + 2*12 + 2*8 = 52 square feet of
  wrapping paper plus 6 square feet of slack, for a total of 58 square feet.
- A present with dimensions 1x1x10 requires 2*1 + 2*10 + 2*10 = 42 square feet
  of wrapping paper plus 1 square foot of slack, for a total of 43 square feet.

All numbers in the elves' list are in feet. How many total square feet of
wrapping paper should they order?
*/

namespace App\Puzzle\Year2015\Day2_IWasToldThereWouldBeNoMath;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
    /**
     * Finds how many total square feet of wrapping paper should elves order.
     *
     * @param string $presentsDimensionsMultilineString
     *
     * @return int Total square feet of wrapping paper
     */
    public function solution($presentsDimensionsMultilineString)
    {
        $totalArea = 0;

        $presentsDimensions = $this->parsePresentsDimensionsMultilineString($presentsDimensionsMultilineString);
        foreach ($presentsDimensions as $presentsDimension) {
            $length = $presentsDimension[0];
            $width = $presentsDimension[1];
            $height = $presentsDimension[2];

            $boxArea = $this->calculateBoxArea($length, $width, $height);
            $totalArea += $boxArea;
        }

        return $totalArea;
    }

    /**
     * Reads presents dimensions multiline string and stores data to array.
     *
     * @param string $presentsDimensionsMultilineString
     *
     * @return array
     */
    public function parsePresentsDimensionsMultilineString(string $presentsDimensionsMultilineString): array
    {
        $presentsDimensions = preg_split('/\n/', $presentsDimensionsMultilineString);
        foreach ($presentsDimensions as $index => $presentDimensions) {
            $presentDimensions = preg_split('/x/', $presentDimensions);
            $presentDimensions = array_map('intval', $presentDimensions);

            $presentsDimensions[$index] = $presentDimensions;
        }

        return $presentsDimensions;
    }

    /**
     * Calculate box area.
     *
     * @param integer $length
     * @param integer $width
     * @param integer $height
     *
     * @return integer
     */
    private function calculateBoxArea(int $length, int $width, int $height): int
    {
        $smallestSideArea = $this->calculateSmallestSideArea($length, $width, $height);
        $boxArea = 2 * $length * $width + 2 * $width * $height + 2 * $height * $length + $smallestSideArea;

        return $boxArea;
    }

    /**
     * Calculate smallest side area.
     *
     * @param integer $length
     * @param integer $width
     * @param integer $height
     *
     * @return integer
     */
    private function calculateSmallestSideArea(int $length, int $width, int $height): int
    {
        $smallestSideArea = $length * $width;

        $sideArea = $width * $height;
        if ($sideArea < $smallestSideArea) {
            $smallestSideArea = $sideArea;
        }

        $sideArea = $height * $length;
        if ($sideArea < $smallestSideArea) {
            $smallestSideArea = $sideArea;
        }

        return $smallestSideArea;
    }
}
