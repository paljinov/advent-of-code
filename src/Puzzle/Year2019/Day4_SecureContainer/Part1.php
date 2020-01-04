<?php

/*
--- Day 4: Secure Container ---

You arrive at the Venus fuel depot only to discover it's protected by a
password. The Elves had written the password on a sticky note, but someone threw
it out.

However, they do remember a few key facts about the password:

It is a six-digit number. The value is within the range given in your puzzle
input. Two adjacent digits are the same (like 22 in 122345). Going from left to
right, the digits never decrease; they only ever increase or stay the same (like
111123 or 135679). Other than the range rule, the following are true:

- 111111 meets these criteria (double 11, never decreases).
- 223450 does not meet these criteria (decreasing pair of digits 50).
- 123789 does not meet these criteria (no double).

How many different passwords within the range given in your puzzle input meet
these criteria?
*/

namespace App\Puzzle\Year2019\Day4_SecureContainer;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
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

        list($minPassword, $maxPassword) = $this->parsePasswordRange($range);

        // Iterate through given password range
        for ($password = $minPassword; $password <= $maxPassword; $password++) {
            $password = (string) $password;

            // Initialize password conditions
            $equalAdjacentMatchingDigits = false;
            $digitsNeverDecrease = true;

            for ($i = 0; $i < strlen($password) - 1; $i++) {
                // If two adjacent digits are the same
                if ($equalAdjacentMatchingDigits === false && $password[$i] === $password[$i + 1]) {
                    $equalAdjacentMatchingDigits = true;
                }

                // The digits never decrease condition
                if ($password[$i] > $password[$i + 1]) {
                    $digitsNeverDecrease = false;
                    break;
                }
            }

            // If both conditions are met
            if ($equalAdjacentMatchingDigits && $digitsNeverDecrease) {
                $meetsCriteria += 1;
            }
        }

        return $meetsCriteria;
    }

    /**
     * Parse given password range.
     *
     * @param string $range
     *
     * @return array
     */
    public function parsePasswordRange(string $range): array
    {
        $rangeArray = explode('-', $range);
        $rangeArray = array_map('intval', $rangeArray);

        return $rangeArray;
    }
}
