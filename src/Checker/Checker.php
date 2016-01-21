<?php

namespace JimmyOak\PhpUnitChecker\Checker;

use JimmyOak\PhpUnitChecker\Config\Config;
use JimmyOak\PhpUnitChecker\Config\SuiteConfig;
use JimmyOak\PhpUnitChecker\Config\JsonConfigReader;
use JimmyOak\Utility\FileUtils;

class Checker
{
    /**
     * @var Config|SuiteConfig[]
     */
    private $config;

    /**
     * Checker constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function check()
    {
        $filesWithoutTests = array();

        foreach ($this->config as $config) {
            $srcFiles = FileUtils::instance()->scanDir($config->getSrcPath(), FileUtils::FILES);
            foreach ($srcFiles as $srcFile) {
                if ($this->isPhpClassFile($srcFile, $config)) {
                    $supposedTestFile = $this->makeSupposedTestFilePath($srcFile, $config);
                    if (!file_exists($supposedTestFile)) {
                        $filesWithoutTests[] = $srcFile;
                    }
                }
            }
        }

        if ($filesWithoutTests) {
            echo 'Classes with no tests:' . "\n";
            foreach ($filesWithoutTests as $fileWithoutTest) {
                echo "\t- " . $fileWithoutTest . "\n";
            }
        }
    }

    private function makeSupposedTestFilePath($srcFile, $config)
    {
        $testFileName = FileUtils::instance()->getNameWithoutExtension($srcFile) .
            $config->getTestCaseSuffix() .
            '.' . FileUtils::instance()->getExtension($srcFile);

        return FileUtils::instance()->makePath(
            $config->getTestPath(),
            $testFileName
        );
    }

    private function fileHasClass($srcFile)
    {
        $fileLines = file($srcFile);
        foreach ($fileLines as $line) {
            if (preg_match('/^\s*class\s*[\w]+/i', $line)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $srcFile
     * @param $config
     *
     * @return bool
     */
    private function isPhpClassFile($srcFile, $config)
    {
        return FileUtils::instance()->extensionIs($srcFile, 'php')
            && $this->fileHasClass(FileUtils::instance()->makePath($config->getSrcPath(), $srcFile));
    }
}