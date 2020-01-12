<?php

/*
--- Day 4: The Ideal Stocking Stuffer ---

Santa needs help mining some AdventCoins (very similar to bitcoins) to use as
gifts for all the economically forward-thinking little girls and boys.

To do this, he needs to find MD5 hashes which, in hexadecimal, start with at
least five zeroes. The input to the MD5 hash is some secret key (your puzzle
input, given below) followed by a number in decimal. To mine AdventCoins, you
must find Santa the lowest positive number (no leading zeroes: 1, 2, 3, ...)
that produces such a hash.

For example:

- If your secret key is abcdef, the answer is 609043, because the MD5 hash of
  abcdef609043 starts with five zeroes (000001dbbfa...), and it is the lowest
  such number to do so.
- If your secret key is pqrstuv, the lowest number it combines with to make an
  MD5 hash starting with five zeroes is 1048970; that is, the MD5 hash of
  pqrstuv1048970 looks like 000006136ef....
*/

namespace App\Puzzle\Year2015\Day4_TheIdealStockingStuffer;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
    /**
     * Finds lowest positive number that produces hash (no leading zeroes:
     * 1, 2, 3, ...), which, in hexadecimal, starts with at least five zeroes.
     *
     * @param string $secretKey
     *
     * @return integer
     */
    public function solution($secretKey)
    {
        $number = $this->findMd5SuffixInputNumber($secretKey, 5);
        return $number;
    }

    /**
     * Finds secret key MD5 input suffix number which creates hash with N leading zeros.
     *
     * @param string $secretKey
     * @param integer $leadingZerosCount
     *
     * @return integer
     */
    public function findMd5SuffixInputNumber(string $secretKey, int $leadingZerosCount): int
    {
        $number = 0;
        $leadingZeros = str_repeat('0', $leadingZerosCount);
        $hash = '';

        while (substr($hash, 0, $leadingZerosCount) !== $leadingZeros) {
            $number++;
            $hash = md5(sprintf('%s%s', $secretKey, $number));
        }

        return $number;
    }
}
