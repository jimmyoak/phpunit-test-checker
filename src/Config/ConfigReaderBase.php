<?php

namespace JimmyOak\PhpUnitChecker\Config;

abstract class ConfigReaderBase implements ConfigReader
{
    public static function readFile($configPath)
    {
        return static::read(file_get_contents($configPath), dirname(realpath($configPath)));
    }
}