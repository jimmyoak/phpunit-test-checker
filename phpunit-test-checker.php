<?php

foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('PHPUNIT_TEST_CHECKER_COMPOSER_INSTALL', $file);

        break;
    }
}

unset($file);

if (!defined('PHPUNIT_TEST_CHECKER_COMPOSER_INSTALL')) {
    fwrite(STDERR,
        'You need to set up the project dependencies using the following commands:' . PHP_EOL .
        'wget http://getcomposer.org/composer.phar' . PHP_EOL .
        'php composer.phar install' . PHP_EOL
    );

    die(1);
}

require_once PHPUNIT_TEST_CHECKER_COMPOSER_INSTALL;

use JimmyOak\PhpUnitChecker\Command\CheckerCommand;
use Symfony\Component\Console\Input\ArgvInput;

$command = new CheckerCommand();
$command->run(new ArgvInput(), new \Symfony\Component\Console\Output\ConsoleOutput());