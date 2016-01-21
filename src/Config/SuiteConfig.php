<?php

namespace JimmyOak\PhpUnitChecker\Config;

use JimmyOak\Utility\FileUtils;

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
     * @var string
     */
    private $basePath;

    /**
     * Config constructor.
     *
     * @param string $srcPath
     * @param string $testPath
     * @param string $testCaseSuffix
     * @param string $basePath
     */
    public function __construct($srcPath, $testPath, $testCaseSuffix, $basePath = '')
    {
        $this->srcPath = $srcPath ?: self::DEFAULT_SRC_PATH;
        $this->testPath = $testPath ?: self::DEFAULT_TEST_PATH;
        $this->testCaseSuffix = $testCaseSuffix ?: self::DEFAULT_TEST_CASE_SUFFIX;

        $this->basePath = $basePath;
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
    public function getSrcBasePath()
    {
        return $this->getBasePath($this->getSrcPath());
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
    public function getTestBasePath()
    {
        return $this->getBasePath($this->getTestPath());
    }

    /**
     * @return string
     */
    public function getTestCaseSuffix()
    {
        return $this->testCaseSuffix;
    }

    /**
     * @param $path
     *
     * @return string
     */
    private function getBasePath($path)
    {
        return FileUtils::instance()->makePath($this->basePath, $path);
    }
}