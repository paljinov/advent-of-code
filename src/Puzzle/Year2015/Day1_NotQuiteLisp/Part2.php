<?php

/*
--- Part Two ---

Now, given the same instructions, find the position of the first character that
causes him to enter the basement (floor -1). The first character in the
instructions has position 1, the second character has position 2, and so on.

For example:

- ) causes him to enter the basement at character position 1.
- ()()) causes him to enter the basement at character position 5.

What is the position of the character that causes Santa to first enter the
basement?
*/

namespace App\Puzzle\Year2015\Day1_NotQuiteLisp;

use App\Puzzle\PuzzleInterface;

class Part2 implements PuzzleInterface
{
    /**
     * Finds the position of the character that causes Santa to first enter the basement.
     *
     * @param string $instructions
     *
     * @return int Basement position
     */
    public function solution($instructions)
    {
        $floor = 0;

        for ($i = 0; $i < strlen($instructions); $i++) {
            $instruction = $instructions[$i];

            switch ($instruction) {
                case '(':
                    $floor++;
                    break;
                case ')':
                    $floor--;
                    break;
                default:
                    break;
            }

            // If basement is entered at character position
            if ($floor === -1) {
                return $i + 1;
            }
        }

        // If basement is not entered
        return 0;
    }
}
