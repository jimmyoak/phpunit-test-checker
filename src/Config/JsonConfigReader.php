<?php

namespace JimmyOak\PhpUnitChecker\Config;

class JsonConfigReader implements ConfigReader
{
    const SRC_PATH_KEY = 'src-path';

    const TEST_PATH_KEY = 'test-path';

    const TEST_CASE_SUFFIX_KEY = 'test-case-suffix';

    private function __construct()
    {
    }

    public static function readFile($configPath)
    {
        return self::read(file_get_contents($configPath));
    }

    public static function read($json)
    {
        $jsonConfig = json_decode($json, true);

        self::guardAgainstMalformedJsonConfig($jsonConfig);

        $config = array();
        foreach ($jsonConfig['suites'] as $suite) {
            $config[] = new SuiteConfig(
                self::getSrcPath($suite),
                self::getTestPath($suite),
                self::getTestCaseSuffix($suite)
            );
        }

        return $config;
    }

    /**
     * @param $jsonConfig
     *
     * @return mixed
     */
    private static function getSrcPath($jsonConfig)
    {
        return isset($jsonConfig[self::SRC_PATH_KEY]) ? $jsonConfig[self::SRC_PATH_KEY] : null;
    }

    /**
     * @param $jsonConfig
     *
     * @return mixed
     */
    private static function getTestPath($jsonConfig)
    {
        return isset($jsonConfig[self::TEST_PATH_KEY]) ? $jsonConfig[self::TEST_PATH_KEY] : null;
    }

    /**
     * @param $jsonConfig
     *
     * @return mixed
     */
    private static function getTestCaseSuffix($jsonConfig)
    {
        return isset($jsonConfig[self::TEST_CASE_SUFFIX_KEY]) ? $jsonConfig[self::TEST_CASE_SUFFIX_KEY] : null;
    }

    /**
     * @param $jsonConfig
     *
     * @return mixed
     */
    private static function guardAgainstMalformedJsonConfig($jsonConfig)
    {
        if (!isset($jsonConfig['suites'])) {
            throw new \RuntimeException('Config has no suites');
        }
    }
}