<?php

/*
--- Day 5: Doesn't He Have Intern-Elves For This? ---

Santa needs help figuring out which strings in his text file are naughty or
nice.

A nice string is one with all of the following properties:

- It contains at least three vowels (aeiou only), like aei, xazegov, or
  aeiouaeiouaeiou.
- It contains at least one letter that appears twice in a row, like xx, abcdde
  (dd), or aabbccdd (aa, bb, cc, or dd).
- It does not contain the strings ab, cd, pq, or xy, even if they are part of
  one of the other requirements.

For example:

- ugknbfddgicrmopn is nice because it has at least three vowels (u...i...o...),
  a double letter (...dd...), and none of the disallowed substrings.
- aaa is nice because it has at least three vowels and a double letter, even
  though the letters used by different rules overlap.
- jchzalrnumimnmhp is naughty because it has no double letter.
- haegwjzuvuyypxyu is naughty because it contains the string xy.
- dvszwmarrgswjxmb is naughty because it contains only one vowel.

How many strings are nice?
*/

namespace App\Puzzle\Year2015\Day5_DoesntHeHaveInternElvesForThis;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
    private const FORBIDDEN_SUBSTRINGS = [
        'ab',
        'cd',
        'pq',
        'xy',
    ];

    private const VOWELS = [
        'a',
        'e',
        'i',
        'o',
        'u',
    ];

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

        $strings = $this->parseMultilineStrings($multilineStrings);
        foreach ($strings as $string) {
            $vowels = 0;
            $doubleLetter = false;
            $disallowedSubstrings = false;

            for ($i = 0; $i < strlen($string); $i++) {
                // String contains at least three vowels condition
                if ($vowels < 3 && in_array($string[$i], self::VOWELS)) {
                    $vowels++;
                }

                if (isset($string[$i + 1])) {
                    // String contains at least one letter that appears twice in a row
                    if (!$doubleLetter && $string[$i] === $string[$i + 1]) {
                        $doubleLetter = true;
                    }

                    if (!$disallowedSubstrings) {
                        $adjacentLetters = sprintf('%s%s', $string[$i], $string[$i + 1]);
                        // String does not contain the substrings ab, cd, pq, or xy
                        if (in_array($adjacentLetters, self::FORBIDDEN_SUBSTRINGS)) {
                            $disallowedSubstrings = true;
                        }
                    }
                }
            }

            if ($vowels === 3 && $doubleLetter && !$disallowedSubstrings) {
                $niceStrings++;
            }
        }

        return $niceStrings;
    }

    /**
     * Parses multiline strings and stores them to array.
     *
     * @param string $multilineStrings
     *
     * @return string[]
     */
    public function parseMultilineStrings(string $multilineStrings): array
    {
        $strings = preg_split('/(\n)/', $multilineStrings);

        return $strings;
    }
}
