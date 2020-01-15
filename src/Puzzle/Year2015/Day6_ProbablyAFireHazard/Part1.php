<?php

/*
--- Day 6: Probably a Fire Hazard ---

Because your neighbors keep defeating you in the holiday house decorating
contest year after year, you've decided to deploy one million lights in a
1000x1000 grid.

Furthermore, because you've been especially nice this year, Santa has mailed you
instructions on how to display the ideal lighting configuration.

Lights in your grid are numbered from 0 to 999 in each direction; the lights at
each corner are at 0,0, 0,999, 999,999, and 999,0. The instructions include
whether to turn on, turn off, or toggle various inclusive ranges given as
coordinate pairs. Each coordinate pair represents opposite corners of a
rectangle, inclusive; a coordinate pair like 0,0 through 2,2 therefore refers to
9 lights in a 3x3 square. The lights all start turned off.

To defeat your neighbors this year, all you have to do is set up your lights by
doing the instructions Santa sent you in order.

For example:

- turn on 0,0 through 999,999 would turn on (or leave on) every light.
- toggle 0,0 through 999,0 would toggle the first line of 1000 lights, turning
  off the ones that were on, and turning on the ones that were off.
- turn off 499,499 through 500,500 would turn off (or leave off) the middle four
  lights.

After following the instructions, how many lights are lit?
*/

namespace App\Puzzle\Year2015\Day6_ProbablyAFireHazard;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
    /**
     * Finds how many lights are lit after following the ideal lighting configuration instructions.
     *
     * @param string $multilineInstructions
     *
     * @return integer
     */
    public function solution($multilineInstructions)
    {
        $gridSide = 1000;
        $grid = $this->initalizeLightsGrid($gridSide);

        $instructions = $this->parseMultilineLightingConfigurationInstructions($multilineInstructions);

        $grid = $this->followLightingConfigurationInstructions($grid, $instructions);

        $lightsLit = $this->countLitLights($grid);

        return $lightsLit;
    }

    /**
     * Initialize lights grid.
     *
     * @param integer $gridSide
     *
     * @return array
     */
    public function initalizeLightsGrid(int $gridSide): array
    {
        $grid = [];

        for ($i = 0; $i < $gridSide; $i++) {
            for ($j = 0; $j < $gridSide; $j++) {
                $grid[$i][$j] = 0;
            }
        }

        return $grid;
    }

    /**
     * Parses multiline instructions on how to display the ideal lighting configuration.
     *
     * @param string $multilineInstructions
     *
     * @return array
     */
    public function parseMultilineLightingConfigurationInstructions(string $multilineInstructions): array
    {
        $instructions = preg_split('/(\n)/', $multilineInstructions);
        $instructions = array_map('trim', $instructions);

        $parsedInstructions = [];
        foreach ($instructions as $instruction) {
            $matches = null;
            preg_match('/(.+) ([0-9]+),([0-9]+) through ([0-9]+),([0-9]+)/', $instruction, $matches);

            $parsedInstruction = [];
            $parsedInstruction['command'] = $matches[1];
            $parsedInstruction['x1'] = (int) $matches[2];
            $parsedInstruction['y1'] = (int) $matches[3];
            $parsedInstruction['x2'] = (int) $matches[4];
            $parsedInstruction['y2'] = (int) $matches[5];

            $parsedInstructions[] = $parsedInstruction;
        }

        return $parsedInstructions;
    }

    /**
     * Count lit lights.
     *
     * @param array $grid
     *
     * @return integer
     */
    private function countLitLights(array $grid): int
    {
        $lightsLit = 0;

        $gridSide = count($grid);

        for ($i = 0; $i < $gridSide; $i++) {
            for ($j = 0; $j < $gridSide; $j++) {
                if ($grid[$i][$j] === 1) {
                    $lightsLit++;
                }
            }
        }

        return $lightsLit;
    }

    /**
     * Follow lighting configuration instructions.
     *
     * @param array $grid
     * @param array $instructions
     *
     * @return array
     */
    private function followLightingConfigurationInstructions(array $grid, array $instructions): array
    {
        foreach ($instructions as $instruction) {
            for ($i = $instruction['x1']; $i <= $instruction['x2']; $i++) {
                for ($j = $instruction['y1']; $j <= $instruction['y2']; $j++) {
                    switch ($instruction['command']) {
                        case 'turn on':
                            $grid[$i][$j] = 1;
                            break;
                        case 'turn off':
                            $grid[$i][$j] = 0;
                            break;
                        case 'toggle':
                            $grid[$i][$j] = (int) !$grid[$i][$j];
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        return $grid;
    }
}
