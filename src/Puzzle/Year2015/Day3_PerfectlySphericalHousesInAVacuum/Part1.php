<?php

/*
--- Day 3: Perfectly Spherical Houses in a Vacuum ---

Santa is delivering presents to an infinite two-dimensional grid of houses.

He begins by delivering a present to the house at his starting location, and
then an elf at the North Pole calls him via radio and tells him where to move
next. Moves are always exactly one house to the north (^), south (v), east (>),
or west (<). After each move, he delivers another present to the house at his
new location.

However, the elf back at the north pole has had a little too much eggnog, and so
his directions are a little off, and Santa ends up visiting some houses more
than once. How many houses receive at least one present?

For example:

- > delivers presents to 2 houses: one at the starting location, and one to the
  > east.
- ^>v< delivers presents to 4 houses in a square, including twice to the house
  at his starting/ending location.
- ^v^v^v^v^v delivers a bunch of presents to some very lucky children at only 2
  houses.
*/

namespace App\Puzzle\Year2015\Day3_PerfectlySphericalHousesInAVacuum;

use App\Puzzle\PuzzleInterface;

class Part1 implements PuzzleInterface
{
    /**
     * Finds how many houses receive at least one present.
     *
     * @param string $moves
     *
     * @return int Number of houses that receive at least one present
     */
    public function solution($moves)
    {
        // Uniquely visited houses coordinates
        $visitedHousesCoordinates = $this->getVisitedHousesCoordinates($moves);

        $visitedHouses = count($visitedHousesCoordinates);

        return $visitedHouses;
    }

    /**
     * Get uniquely visited houses coordinates.
     *
     * @param string $moves
     *
     * @return string[] Visited houses coordinates ['x,y', 'x,y', ...]
     */
    public function getVisitedHousesCoordinates(string $moves): array
    {
        // System can be imagined as Cartesian coordinate system, where Santa starts moving from origin (0,0),
        // and it is needed to count uniquely visited houses
        $uniquelyVisitedHousesCoordinates = [];
        // House at (0,0) is Santa's origin, and is always visited
        $uniquelyVisitedHousesCoordinates[] = '0,0';

        $x = 0;
        $y = 0;

        // Iterating through Santa's moves
        for ($i = 0; $i < strlen($moves); $i++) {
            switch ($moves[$i]) {
                // North
                case '^':
                    $y++;
                    break;
                // South
                case 'v':
                    $y--;
                    break;
                // East
                case '>':
                    $x++;
                    break;
                // West
                case '<':
                    $x--;
                    break;
                default:
                    break;
            }

            $coordinates = sprintf('%s,%s', $x, $y);
            // If house with coordinates was never visited
            if (!in_array($coordinates, $uniquelyVisitedHousesCoordinates)) {
                $uniquelyVisitedHousesCoordinates[] = $coordinates;
            }
        }

        return $uniquelyVisitedHousesCoordinates;
    }
}
