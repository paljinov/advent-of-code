<?php

namespace App\Service;

use App\Helper\ProjectPath;

use RuntimeException;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class PuzzleLocatorService
{
    /**
     * Gets filepath for puzzle year, day and part if such exists.
     *
     * @param integer $year
     * @param integer $day
     * @param integer $part
     * 
     * @return string|null
     */
    public function getPuzzleFilepath(int $year, int $day, int $part): ?string
    {
        try {
            $projectPuzzleDir = ProjectPath::getProjectPuzzleDir();
        } catch (RuntimeException $e) {
            return null;
        }

        $yearDir = sprintf('%s/%s', $projectPuzzleDir, $year);
        // If puzzle year exists
        if (!file_exists($yearDir)) {
            return null;
        }

        $dayDirs = scandir($yearDir);
        $dayDir = null;

        foreach (is_array($dayDirs) ? $dayDirs : [] as $dirName) {
            if (preg_match('/Day\s?([1-9]{1,2})/', $dirName, $matches)) {
                // If directory matches puzzle day
                if ($matches[1] == $day) {
                    $dayDir = sprintf('%s/%s', $yearDir, $dirName);
                    break;
                }
            }
        }

        if ($dayDir === null) {
            return null;
        }

        $partDirs = scandir($dayDir);
        $partDir = null;

        foreach (is_array($partDirs) ? $partDirs : [] as $dirName) {
            if (preg_match('/Part\s?([1-2])/', $dirName, $matches)) {
                // If directory matches puzzle part
                if ($matches[1] == $part) {
                    $partDir = sprintf('%s/%s', $dayDir, $dirName);
                    break;
                }
            }
        }

        return $partDir;
    }

    /**
     * Runs puzzle with given path.
     *
     * @param string $puzzleFilepath Puzzle filepath
     * @param string $input Puzzle input
     * 
     * @return string Puzzle output
     */
    public function runPuzzle(string $puzzleFilepath, $input): string
    {
        if (!file_exists($puzzleFilepath)) {
            throw new InvalidArgumentException(sprintf(
                'Puzzle with filepath "%s" does\'t exists.',
                $puzzleFilepath
            ));
        }

        require $puzzleFilepath;
        $output = solution($input);

        return (string) $output;
    }
}
