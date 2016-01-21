<?php

namespace JimmyOak\PhpUnitChecker\Command;

use JimmyOak\PhpUnitChecker\Checker\Checker;
use JimmyOak\PhpUnitChecker\Config\JsonConfigReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CheckerCommand extends Command
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {
        $this->setName('phpunit-test:check')
            ->setDescription('PHPUnit test checker')
            ->addOption('config', 'c', InputOption::VALUE_OPTIONAL, 'Path to PHPUnit test checker configuration', 'phpunit-test-checker.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setUp($input, $output);

        $checker = new Checker(JsonConfigReader::readFile($input->getOption('config')));
        $checker->check();
    }

    private function setUp($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}