<?php

/*
--- Part Two ---

It turns out that this circuit is very timing-sensitive; you actually need to
minimize the signal delay.

To do this, calculate the number of steps each wire takes to reach each
intersection; choose the intersection where the sum of both wires' steps is
lowest. If a wire visits a position on the grid multiple times, use the steps
value from the first time it visits that position when calculating the total
value of a specific intersection.

The number of steps a wire takes is the total number of grid squares the wire
has entered to get to that location, including the intersection being
considered. Again consider the example from above:

...........
.+-----+...
.|.....|...
.|..+--X-+.
.|..|..|.|.
.|.-X--+.|.
.|..|....|.
.|.......|.
.o-------+.
...........

In the above example, the intersection closest to the central port is reached
after 8+5+5+2 = 20 steps by the first wire and 7+6+4+3 = 20 steps by the second
wire for a total of 20+20 = 40 steps.

However, the top-right intersection is better: the first wire takes only 8+5+2 =
15 and the second wire takes only 7+6+2 = 15, a total of 15+15 = 30 steps.

Here are the best steps for the extra examples from above:

- R75,D30,R83,U83,L12,D49,R71,U7,L72
  U62,R66,U55,R34,D71,R55,D58,R83 = 610 steps
- R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
  U98,R91,D20,R16,D67,R40,U7,R15,U6,R7 = 410 steps

What is the fewest combined steps the wires must take to reach an intersection?
*/

namespace App\Puzzle\Year2019\Day3_CrossedWires;

use App\Puzzle\PuzzleInterface;

class Part2 implements PuzzleInterface
{
    private $part1;

    public function __construct()
    {
        // Needed function(s) are already implemented in part1
        $this->part1 = new Part1();
    }

    /**
     * Determines fewest combined steps the wires must take to reach an intersection.
     *
     * @param string Wires paths separated by spaces or newline
     * 
     * @return integer Fewest combined steps the wires must take to reach an intersection
     */
    public function solution($wiresPaths)
    {
        // Parse wires paths to array
        $wiresPathsArray = $this->part1->parseWirePaths($wiresPaths);

        // Coordinates through which the wire passes
        $firstWireCoordinates = $this->part1->calculateWireCoordinates($wiresPathsArray[0]);
        $secondWireCoordinates = $this->part1->calculateWireCoordinates($wiresPathsArray[1]);

        $intersections = $this->part1->calculateAllIntersections($firstWireCoordinates, $secondWireCoordinates);
        $fewestCombinedStep = $this->calculateFewestCombinedStepsForBothWires($intersections, $firstWireCoordinates, $secondWireCoordinates);

        return $fewestCombinedStep;
    }

    /**
     * Calculate fewest combined steps for both wires.
     *
     * @param array $intersections
     * @param array $firstWireCoordinates
     * @param array $secondWireCoordinates
     * 
     * @return integer
     */
    private function calculateFewestCombinedStepsForBothWires(
        array $intersections,
        array $firstWireCoordinates,
        array $secondWireCoordinates
    ): int {
        $minSteps = null;

        foreach ($intersections as $intersection) {
            $firstWireDistance = $this->calculateFewestCombinedStepsToIntersectionForWire(
                $intersection,
                $firstWireCoordinates
            );
            $secondWireDistance = $this->calculateFewestCombinedStepsToIntersectionForWire(
                $intersection,
                $secondWireCoordinates
            );

            $totalSteps = $firstWireDistance + $secondWireDistance;
            if ($minSteps === null || $totalSteps < $minSteps) {
                $minSteps = $totalSteps;
            }
        }

        return $minSteps;
    }

    /**
     * Calculate fewest combined steps to intersection for wire.
     *
     * @param array $intersection
     * @param array $wireCoordinatess
     * 
     * @return int
     */
    private function calculateFewestCombinedStepsToIntersectionForWire(array $intersection, array $wireCoordinates): int
    {
        $iX = $intersection['x'];
        $iY = $intersection['y'];

        $wireDistance = 0;
        for ($i = 0; $i < count($wireCoordinates) - 1; $i++) {
            $x1 = $wireCoordinates[$i]['x'];
            $y1 = $wireCoordinates[$i]['y'];

            $x2 = $wireCoordinates[$i + 1]['x'];
            $y2 = $wireCoordinates[$i + 1]['y'];

            // If intersection is on X axis, it needs to be between x1 and x2 line points
            if ($y1 === $iY && (($x1 < $iX && $x2 > $iX) || ($x1 > $iX && $x2 < $iX))) {
                $wireDistance += abs($x1 - $iX);
                break;
            }

            // If intersection is on Y axis, it needs to be between y1 and y2 line points
            if ($x1 === $iX && (($y1 < $iY && $y2 > $iY) || ($y1 > $iY && $y2 < $iY))) {
                $wireDistance += abs($y1 - $iY);
                break;
            }

            // Moving along X axis
            if ($y1 === $y2) {
                $wireDistance += abs($x2 - $x1);
            }

            // Moving along Y axis
            if ($x1 === $x2) {
                $wireDistance += abs($y2 - $y1);
            }
        }

        return $wireDistance;
    }
}
