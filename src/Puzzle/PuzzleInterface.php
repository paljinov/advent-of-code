<?php

namespace App\Puzzle;

interface PuzzleInterface
{
    /**
     * Puzzle entry method.
     *
     * @param mixed ...$inputs
     * 
     * @return string
     */
    public function solution(...$inputs): string;
}
