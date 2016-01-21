<?php

require_once __DIR__ . '/vendor/autoload.php';

use JimmyOak\PhpUnitChecker\Command\CheckerCommand;
use Symfony\Component\Console\Input\ArgvInput;

$command = new CheckerCommand();
$command->run(new ArgvInput(), new \Symfony\Component\Console\Output\ConsoleOutput());