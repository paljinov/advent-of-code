<?php

namespace App\Command;

use App\Service\PuzzleLocatorService;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PuzzleRunnerCommand extends Command
{
    protected static $defaultName = 'puzzle:run';

    /**
     * Puzzle locator service.
     * 
     * @var PuzzleLocatorService $puzzleLocatorService
     */
    private $puzzleLocatorService;

    public function __construct()
    {
        $this->puzzleLocatorService = new PuzzleLocatorService();

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Advent of code puzzle runner.')
            ->addArgument('year', InputArgument::REQUIRED, 'Puzzle year')
            ->addArgument('day', InputArgument::REQUIRED, 'Puzzle day')
            ->addArgument('part', InputArgument::REQUIRED, 'Puzzle part')
            ->addArgument('puzzle_input', InputArgument::REQUIRED, 'Puzzle input');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getArgument('year');
        if (!filter_var($year, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(sprintf('Puzzle year "%s" is not valid integer.', $year));
        }
        $year = (int) $year;

        $day = $input->getArgument('day');
        if (!filter_var($day, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(sprintf('Puzzle day "%s" is not valid integer.', $day));
        }
        $day = (int) $day;

        $part = $input->getArgument('part');
        if (!filter_var($part, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(sprintf('Puzzle part "%s" is not valid integer.', $part));
        }
        $part = (int) $part;

        $puzzleFilepath = $this->puzzleLocatorService->getPuzzleFilepath($year, $day, $part);
        if ($puzzleFilepath === null) {
            throw new LogicException(sprintf(
                'Puzzle from year "%s", day "%s" and part "%s" does not exist.',
                $year,
                $day,
                $part
            ));
        }

        $puzzleInput = $input->getArgument('puzzle_input');
        $puzzleOutput = $this->puzzleLocatorService->runPuzzle($puzzleFilepath, $puzzleInput);

        $output->writeln([
            '<info>' . sprintf('Output for puzzle year %s, day %s and part %s', $year, $day, $part) . '<info>',
            '<info>================================================<info>',
            '<info>' . $puzzleOutput . '<info>',
        ]);

        return 0;
    }
}
