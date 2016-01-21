<?php

use JimmyOak\PhpUnitChecker\Checker\Checker;

require_once __DIR__ . '/vendor/autoload.php';

$checker = new Checker(\JimmyOak\PhpUnitChecker\Config\JsonConfigReader::readFile(__DIR__ . '/phpunit-test-checker.json'));
$checker->check();