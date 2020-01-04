<?php

/*
--- Day 3: Crossed Wires ---

The gravity assist was successful, and you're well on your way to the Venus
refuelling station. During the rush back on Earth, the fuel management system
wasn't completely installed, so that's next on the priority list.

Opening the front panel reveals a jumble of wires. Specifically, two wires are
connected to a central port and extend outward on a grid. You trace the path
each wire takes as it leaves the central port, one wire per line of text (your
puzzle input).

The wires twist and turn, but the two wires occasionally cross paths. To fix the
circuit, you need to find the intersection point closest to the central port.
Because the wires are on a grid, use the Manhattan distance for this
measurement. While the wires do technically cross right at the central port
where they both start, this point does not count, nor does a wire count as
crossing with itself.

For example, if the first wire's path is R8,U5,L5,D3, then starting from the
central port (o), it goes right 8, up 5, left 5, and finally down 3:

...........
...........
...........
....+----+.
....|....|.
....|....|.
....|....|.
.........|.
.o-------+.
...........

Then, if the second wire's path is U7,R6,D4,L4, it goes up 7, right 6, down 4,
and left 4:

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

These wires cross at two locations (marked X), but the lower-left one is closer
to the central port: its distance is 3 + 3 = 6.

Here are a few more examples:

- R75,D30,R83,U83,L12,D49,R71,U7,L72
  U62,R66,U55,R34,D71,R55,D58,R83    = distance 159
- R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
  U98,R91,D20,R16,D67,R40,U7,R15,U6,R7        = distance 135

What is the Manhattan distance from the central port to the closest
intersection?
*/

namespace App\Puzzle\Year2019\Day3_CrossedWires;

use App\Puzzle\PuzzleInterface;
use RuntimeException;

class Part1 implements PuzzleInterface
{
    // Central port x and y axis coordinates, all wires start here
    private const CENTRAL_PORT = [
        'x' => 1,
        'y' => 1,
    ];

    /**
     * Determines Manhattan distance from the central port to the closest intersection.
     *
     * @param string $wiresPaths Wires paths separated by spaces or newline
     *
     * @return integer Manhattan distance from the central port to the closest intersection
     */
    public function solution($wiresPaths)
    {
        // Parse wires paths to array
        $wiresPathsArray = $this->parseWirePaths($wiresPaths);

        // Coordinates through which the wire passes
        $firstWireCoordinates = $this->calculateWireCoordinates($wiresPathsArray[0]);
        $secondWireCoordinates = $this->calculateWireCoordinates($wiresPathsArray[1]);

        $intersections = $this->calculateAllIntersections($firstWireCoordinates, $secondWireCoordinates);
        $minManhattanDistance = $this->calculateMinimumManhattanDistance($intersections);

        return $minManhattanDistance;
    }

    /**
     * Parses wire paths string to array.
     *
     * @param string $wiresPaths
     *
     * @return array
     */
    public function parseWirePaths(string $wiresPaths): array
    {
        // Split to 2 wires and trim paths
        $wiresPathsArray = preg_split('/(\r\n|\n|\r)/', $wiresPaths);
        $wiresPathsArray = array_map('trim', $wiresPathsArray);

        // Explode each wire paths to array
        $wiresPathsArray = array_map('explode', array_fill(0, count($wiresPathsArray), ','), $wiresPathsArray);

        return $wiresPathsArray;
    }

    /**
     * Calculate all wire turning point coordinates.
     *
     * @param array $wirePath
     *
     * @return array [0 => ['x' => int, 'y' => int], ...]
     */
    public function calculateWireCoordinates($wirePath): array
    {
        $wireCoordinates = [];
        $wireCoordinates[0] = self::CENTRAL_PORT;

        foreach ($wirePath as $directionAndDistance) {
            $lastWireCoordinatesKey = count($wireCoordinates) - 1;

            $direction = $directionAndDistance[0];
            $distance = (int) substr($directionAndDistance, 1);

            switch ($direction) {
                case 'R':
                    // Right

                    $turnCoordinate = [
                        'x' => $wireCoordinates[$lastWireCoordinatesKey]['x'] + $distance,
                        'y' => $wireCoordinates[$lastWireCoordinatesKey]['y'],
                    ];
                    break;
                case 'U':
                    // Up

                    $turnCoordinate = [
                        'x' => $wireCoordinates[$lastWireCoordinatesKey]['x'],
                        'y' => $wireCoordinates[$lastWireCoordinatesKey]['y'] + $distance,
                    ];
                    break;
                case 'L':
                    // Left

                    $turnCoordinate = [
                        'x' => $wireCoordinates[$lastWireCoordinatesKey]['x'] - $distance,
                        'y' => $wireCoordinates[$lastWireCoordinatesKey]['y'],
                    ];
                    break;
                case 'D':
                    // Down

                    $turnCoordinate = [
                        'x' => $wireCoordinates[$lastWireCoordinatesKey]['x'],
                        'y' => $wireCoordinates[$lastWireCoordinatesKey]['y'] - $distance,
                    ];
                    break;
                default:
                    throw new RuntimeException(sprintf('Unsupported wire direction "%s"', $direction));
            }

            $wireCoordinates[$lastWireCoordinatesKey + 1] = $turnCoordinate;
        }

        return $wireCoordinates;
    }

    /**
     * Calculate all intersections between wires.
     *
     * @param array $firstWireCoordinates Coordinates through which the wire passes
     * @param array $secondWireCoordinates Coordinates through which the wire passes
     *
     * @return array Intersections [0 => ['x' => int, 'y' => int], ...]
     */
    public function calculateAllIntersections(array $firstWireCoordinates, array $secondWireCoordinates): array
    {
        // Intersections
        $intersections = [];

        // Wires always intersect at right angle, and first line cannot intersect
        for ($i = 1; $i < count($firstWireCoordinates) - 1; $i++) {
            for ($j = 1; $j < count($secondWireCoordinates) - 1; $j++) {
                $intersection = $this->calculateIntersectionForLinesBetweenPoints(
                    $firstWireCoordinates[$i],
                    $firstWireCoordinates[$i + 1],
                    $secondWireCoordinates[$j],
                    $secondWireCoordinates[$j + 1]
                );

                // If intersection is found
                if (is_array($intersection)) {
                    $intersections[] = $intersection;
                }
            }
        }

        return $intersections;
    }

    /**
     * Calculates intersection for lines defined between points on X and Y axis.
     *
     * @param array $a ['x' => int, 'y' => int] First wire start point
     * @param array $b ['x' => int, 'y' => int] First wire end point
     * @param array $c ['x' => int, 'y' => int] Second wire start point
     * @param array $d ['x' => int, 'y' => int] Second wire end point
     *
     * @return array|null ['x' => int, 'y' => int] Intersection or null if there is no intersection between lines
     */
    private function calculateIntersectionForLinesBetweenPoints(array $a, array $b, array $c, array $d): ?array
    {
        // https://en.wikipedia.org/wiki/Line%E2%80%93line_intersection#Given_two_points_on_each_line

        $x1 = $a['x'];
        $y1 = $a['y'];
        $x2 = $b['x'];
        $y2 = $b['y'];
        $x3 = $c['x'];
        $y3 = $c['y'];
        $x4 = $d['x'];
        $y4 = $d['y'];

        // If first wire ends before second wire starts on X axis
        if (max($x1, $x2) < min($x3, $x4)) {
            return null;
        }
        // If first wire starts after second wire ends on X axis
        if (min($x1, $x2) > max($x3, $x4)) {
            return null;
        }
        // If first wire ends before second wire starts on Y axis
        if (max($y1, $y2) < min($y3, $y4)) {
            return null;
        }
        // If first wire starts after second wire ends on Y axis
        if (min($y1, $y2) > max($y3, $y4)) {
            return null;
        }

        // By equation divisor is the same for calculating x and y part of intersection point
        $divisor = ($x1 - $x2) * ($y3 - $y4) - ($y1 - $y2) * ($x3 - $x4);
        // Calculating intersection
        $intersectionX = (($x1 * $y2 - $y1 * $x2) * ($x3 - $x4) - ($x1 - $x2) * ($x3 * $y4 - $y3 * $x4)) / $divisor;
        $intersectionY = (($x1 * $y2 - $y1 * $x2) * ($y3 - $y4) - ($y1 - $y2) * ($x3 * $y4 - $y3 * $x4)) / $divisor;

        return [
            'x' => $intersectionX,
            'y' => $intersectionY
        ];
    }

    /**
     * Calculates minimum Manhattan distance from the central port to the wires intersection.
     *
     * @param array $intersections [0 => ['x' => int, 'y' => int], ...]
     *
     * @return int
     */
    private function calculateMinimumManhattanDistance(array $intersections): int
    {
        // Minimum distance initalization
        $minDistance = abs($intersections[0]['x'] - self::CENTRAL_PORT['x'])
            + abs($intersections[0]['y'] - self::CENTRAL_PORT['y']);

        unset($intersections[0]);

        foreach ($intersections as $intersection) {
            $x = $intersection['x'];
            $y = $intersection['y'];

            $distance = abs($x - self::CENTRAL_PORT['x']) + abs($y - self::CENTRAL_PORT['y']);
            if ($distance < $minDistance) {
                $minDistance = $distance;
            }
        }

        return $minDistance;
    }
}
