<?php

namespace App\Puzzle;

interface PuzzleInterface
{
    /**
     * Puzzle entry method.
     *
     * @param mixed ...$inputs
     * 
     * @return mixed
     */
    public function solution(...$inputs);
}
