<?php

/*
--- Part Two ---

An Elf just remembered one more important detail: the two adjacent matching
digits are not part of a larger group of matching digits.

Given this additional criterion, but still ignoring the range rule, the
following are now true:

- 112233 meets these criteria because the digits never decrease and all repeated
  digits are exactly two digits long.
- 123444 no longer meets the criteria (the repeated 44 is part of a larger group
  of 444).
- 111122 meets the criteria (even though 1 is repeated more than twice, it still
  contains a double 22).

How many different passwords within the range given in your puzzle input meet
all of the criteria?
*/

namespace App\Puzzle\Year2019\Day4_SecureContainer;

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
     * Determines how many different passwords within the given range meets criteria.
     *
     * @param string $range Given password range
     *
     * @return int Number of passwords within the given range which meet criteria
     */
    public function solution($range)
    {
        $meetsCriteria = 0;

        list($minPassword, $maxPassword) = $this->part1->parsePasswordRange($range);

        // Iterate through given password range
        for ($password = $minPassword; $password <= $maxPassword; $password++) {
            $password = (string) $password;

            // Initialize password conditions
            $equalAdjacentDigits = false;
            $digitsNeverDecrease = true;

            $i = 0;
            while ($i < strlen($password) - 1) {
                // If two adjacent digits are the same
                if ($password[$i] === $password[$i + 1]) {
                    $equalAdjacentDigitsCount = 2;

                    // Moving to 3rd adjacent digit
                    if (isset($password[$i + 2])) {
                        $repeatingDigit = $password[$i];
                        $i += 2;

                        // While next digit exists
                        while (isset($password[$i])) {
                            if ($repeatingDigit === $password[$i]) {
                                // If adjacent digit repeats itself
                                $equalAdjacentDigitsCount += 1;
                                $i++;
                            } else {
                                // If adjacent digit is changed
                                $i--;
                                break;
                            }
                        }

                        // If all needed digits are processed
                        if ($i >= strlen($password) - 1) {
                            break;
                        }
                    }

                    // If adjacent digit is not part of a larger group
                    if ($equalAdjacentDigitsCount === 2) {
                        $equalAdjacentDigits = true;
                    }
                }

                // The digits never decrease condition
                if ($password[$i] > $password[$i + 1]) {
                    $digitsNeverDecrease = false;
                    break;
                }

                $i++;
            }

            // If conditions are met
            if ($equalAdjacentDigits && $digitsNeverDecrease) {
                $meetsCriteria += 1;
            }
        }

        return $meetsCriteria;
    }
}
