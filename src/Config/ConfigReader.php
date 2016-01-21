<?php

namespace JimmyOak\PhpUnitChecker\Config;

interface ConfigReader
{
    /**
     * @param $configPath
     *
     * @return SuiteConfig[]
     */
    public static function readFile($configPath);

    /**
     * @param $json
     *
     * @return SuiteConfig[]
     */
    public static function read($json, $basePath = '');
}