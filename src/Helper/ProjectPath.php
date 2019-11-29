<?php

namespace App\Helper;

use RuntimeException;

class ProjectPath
{
    /**
     * Gets the project puzzle dir.
     *
     * @throws RuntimeException If project root directory cannot be found
     * 
     * @return string The project puzzle dir
     */
    public static function getProjectPuzzleDir(): string
    {
        $projectRootDir = self::getProjectRootDir();
        $projectPuzzleDir = $projectRootDir . '/src/Puzzle';

        return $projectPuzzleDir;
    }

    /**
     * Gets the project root dir (path of the project's composer file).
     *
     * @throws RuntimeException If project root directory cannot be found
     * 
     * @return string The project root dir
     */
    private static function getProjectRootDir(): string
    {
        $dir = __DIR__;

        // Climbing the directory tree until composer.json is found
        while (!file_exists($dir . '/composer.json')) {
            if ($dir === '/') {
                throw new RuntimeException('Project root directory cannot be found.');
            }

            $dir = dirname($dir);
        }

        return $dir;
    }
}
