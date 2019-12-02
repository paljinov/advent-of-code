<?php

/*
--- Part Two ---

You notice a progress bar that jumps to 50% completion. Apparently, the door
isn't yet satisfied, but it did emit a star as encouragement. The instructions
change:

Now, instead of considering the next digit, it wants you to consider the digit
halfway around the circular list. That is, if your list contains 10 items, only
include a digit in your sum if the digit 10/2 = 5 steps forward matches it.
Fortunately, your list has an even number of elements.

For example:
- 1212 produces 6: the list contains 4 items, and all four digits match the
  digit 2 items ahead.
- 1221 produces 0, because every comparison is between a 1 and a 2.
- 123425 produces 4, because both 2s match each other, but no other digit has a
  match.
- 123123 produces 12.
- 12131415 produces 4.

What is the solution to your new captcha?
*/

namespace App\Puzzle\Year2017\Day1InverseCaptcha;

use App\Puzzle\PuzzleInterface;

class Part2 implements PuzzleInterface
{
    /**
     * Finds the sum of all digits that match the N / 2 steps forward digit in the circular list.
     *
     * @param string $digitsSequence Digits list
     *
     * @return int Sum
     */
    public function solution($digitsSequence)
    {
        $sum = 0;

        $digits = array_map('intval', str_split($digitsSequence, 1));
        $matchForwardSteps = count($digits) / 2;

        for ($i = 0; $i < count($digits); $i++) {
            $currentDigit = $digits[$i];

            // List is circular
            if ($i + $matchForwardSteps < count($digits)) {
                $nextDigit = $digits[$i + $matchForwardSteps];
            } else {
                $nextDigit = $digits[$i - count($digits) + $matchForwardSteps];
            }

            // If current digit matches the one N / 2 steps forward
            if ($currentDigit === $nextDigit) {
                $sum += $currentDigit;
            }
        }

        return $sum;
    }
}
