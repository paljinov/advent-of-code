<?php

/*
--- Part Two ---

You just finish implementing your winning light pattern when you realize you
mistranslated Santa's message from Ancient Nordic Elvish.

The light grid you bought actually has individual brightness controls; each
light can have a brightness of zero or more. The lights all start at zero.

The phrase turn on actually means that you should increase the brightness of
those lights by 1.

The phrase turn off actually means that you should decrease the brightness of
those lights by 1, to a minimum of zero.

The phrase toggle actually means that you should increase the brightness of
those lights by 2.

What is the total brightness of all lights combined after following Santa's
instructions?

For example:

- turn on 0,0 through 0,0 would increase the total brightness by 1.
- toggle 0,0 through 999,999 would increase the total brightness by 2000000.
*/

namespace App\Puzzle\Year2015\Day6_ProbablyAFireHazard;

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
     * Finds what is the total brightness of all lights combined after following Santa's instructions.
     *
     * @param string $multilineInstructions
     *
     * @return integer
     */
    public function solution($multilineInstructions)
    {
        $gridSide = 1000;
        $grid = $this->part1->initalizeLightsGrid($gridSide);

        $instructions = $this->part1->parseMultilineLightingConfigurationInstructions($multilineInstructions);

        $grid = $this->calculateLightingBrightnessAfterInstructions($grid, $instructions);

        $totalBrightness = $this->calculateTotalBrightness($grid);

        return $totalBrightness;
    }

    /**
     * Follow lighting configuration instructions.
     *
     * @param array $grid
     * @param array $instructions
     *
     * @return array
     */
    private function calculateLightingBrightnessAfterInstructions(array $grid, array $instructions): array
    {
        foreach ($instructions as $instruction) {
            for ($i = $instruction['x1']; $i <= $instruction['x2']; $i++) {
                for ($j = $instruction['y1']; $j <= $instruction['y2']; $j++) {
                    switch ($instruction['command']) {
                        case 'turn on':
                            $grid[$i][$j] += 1;
                            break;
                        case 'turn off':
                            $grid[$i][$j] = $grid[$i][$j] ? $grid[$i][$j] - 1 : 0;
                            break;
                        case 'toggle':
                            $grid[$i][$j] += 2;
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        return $grid;
    }

    /**
     * Calculate total lights brightness.
     *
     * @param array $grid
     *
     * @return integer
     */
    private function calculateTotalBrightness(array $grid): int
    {
        $totalBrightness = 0;

        $gridSide = count($grid);

        for ($i = 0; $i < $gridSide; $i++) {
            for ($j = 0; $j < $gridSide; $j++) {
                $totalBrightness += $grid[$i][$j];
            }
        }

        return $totalBrightness;
    }
}
