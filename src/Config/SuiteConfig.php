<?php

namespace JimmyOak\PhpUnitChecker\Config;

class SuiteConfig
{
    const DEFAULT_TEST_CASE_SUFFIX = 'Test';
    const DEFAULT_SRC_PATH = 'src';
    const DEFAULT_TEST_PATH = 'test';

    /**
     * @var string
     */
    private $srcPath;

    /**
     * @var string
     */
    private $testPath;

    /**
     * @var string
     */
    private $testCaseSuffix;

    /**
     * Config constructor.
     *
     * @param string $srcPath
     * @param string $testPath
     * @param string $testCaseSuffix
     */
    public function __construct($srcPath, $testPath, $testCaseSuffix)
    {
        $this->srcPath = $srcPath ?: self::DEFAULT_SRC_PATH;
        $this->testPath = $testPath ?: self::DEFAULT_TEST_PATH;
        $this->testCaseSuffix = $testCaseSuffix ?: self::DEFAULT_TEST_CASE_SUFFIX;
    }

    /**
     * @return string
     */
    public function getSrcPath()
    {
        return $this->srcPath;
    }

    /**
     * @return string
     */
    public function getTestPath()
    {
        return $this->testPath;
    }

    /**
     * @return string
     */
    public function getTestCaseSuffix()
    {
        return $this->testCaseSuffix;
    }
}