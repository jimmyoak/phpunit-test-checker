<?php

namespace JimmyOak\PhpUnitChecker\Config;

class JsonConfigReader extends ConfigReaderBase
{
    const SRC_PATH_KEY = 'src-path';

    const TEST_PATH_KEY = 'test-path';

    const TEST_CASE_SUFFIX_KEY = 'test-case-suffix';

    const EXCLUDED_PATHS_KEY = 'excluded';

    private function __construct()
    {
    }

    public static function read($json, $basePath = '')
    {
        $jsonConfig = json_decode($json, true);

        self::guardAgainstMalformedJsonConfig($jsonConfig);

        $config = array();
        foreach ($jsonConfig['suites'] as $suite) {
            $config[] = new SuiteConfig(
                self::getSrcPath($suite),
                self::getTestPath($suite),
                self::getTestCaseSuffix($suite),
                $basePath,
                self::getExcludedPaths($suite)
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
     * @return array
     */
    private static function getExcludedPaths($jsonConfig)
    {
        return isset($jsonConfig[self::EXCLUDED_PATHS_KEY]) ? $jsonConfig[self::EXCLUDED_PATHS_KEY] : array();
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