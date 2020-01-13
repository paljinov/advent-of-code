<?php

/*
--- Part Two ---

Realizing the error of his ways, Santa has switched to a better model of
determining whether a string is naughty or nice. None of the old rules apply, as
they are all clearly ridiculous.

Now, a nice string is one with all of the following properties:

- It contains a pair of any two letters that appears at least twice in the
  string without overlapping, like xyxy (xy) or aabcdefgaa (aa), but not like
  aaa (aa, but it overlaps).
- It contains at least one letter which repeats with exactly one letter between
  them, like xyx, abcdefeghi (efe), or even aaa.

For example:

- qjhvhtzxzqqjkmpb is nice because is has a pair that appears twice (qj) and a
  letter that repeats with exactly one letter between them (zxz).
- xxyxx is nice because it has a pair that appears twice and a letter that
  repeats with one between, even though the letters used by each rule overlap.
- uurcxstgmygtbstg is naughty because it has a pair (tg) but no repeat with a
  single letter between them.
- ieodomkazucvgmuy is naughty because it has a repeating letter with one between
  (odo), but no pair that appears twice.

How many strings are nice under these new rules?
*/

namespace App\Puzzle\Year2015\Day5_DoesntHeHaveInternElvesForThis;

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
     * Finds how many strings are nice.
     *
     * @param string $multilineStrings
     *
     * @return integer
     */
    public function solution($multilineStrings)
    {
        $niceStrings = 0;

        $strings = $this->part1->parseMultilineStrings($multilineStrings);
        foreach ($strings as $string) {
            $samePairLetter = null;
            $pairLetters = [];
            $surroundingLetters = false;

            for ($i = 0; $i < strlen($string) - 1; $i++) {
                $adjacentLetters = sprintf('%s%s', $string[$i], $string[$i + 1]);

                // If adjacent letters already appeared
                if (isset($pairLetters[$adjacentLetters])) {
                    // Two letters don't overlap
                    if ($samePairLetter === null || $samePairLetter != $string[$i + 1]) {
                        $pairLetters[$adjacentLetters]++;
                    }
                } else {
                    $pairLetters[$adjacentLetters] = 1;
                }

                // If same pair letter flag was already used for overlap prevention
                if (isset($samePairLetter)) {
                    $samePairLetter = null;
                } elseif ($string[$i] === $string[$i + 1]) {
                    $samePairLetter = $string[$i];
                }

                if (isset($string[$i + 2]) && $string[$i] === $string[$i + 2]) {
                    $surroundingLetters = true;
                }
            }

            if (max($pairLetters) >= 2 && $surroundingLetters) {
                $niceStrings++;
            }
        }

        return $niceStrings;
    }
}
