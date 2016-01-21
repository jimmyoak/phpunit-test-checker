<?php

namespace JimmyOak\PhpUnitChecker\Checker;

use JimmyOak\PhpUnitChecker\Config\SuiteConfig;
use JimmyOak\Utility\FileUtils;

class Checker
{
    /**
     * @var SuiteConfig[]
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
            $srcFiles = FileUtils::instance()->scanDir($config->getSrcBasePath(), FileUtils::FILES);
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
            $msg = 'Classes with no tests:' . "\n";
            foreach ($filesWithoutTests as $fileWithoutTest) {
                $msg .= "\t- " . $fileWithoutTest . "\n";
            }

            throw new \RuntimeException($msg);
        }
    }

    /**
     * @param $srcFile
     * @param SuiteConfig $config
     *
     * @return string
     */
    private function makeSupposedTestFilePath($srcFile, $config)
    {
        $testFileName = FileUtils::instance()->getNameWithoutExtension($srcFile) .
            $config->getTestCaseSuffix() .
            '.' . FileUtils::instance()->getExtension($srcFile);

        return FileUtils::instance()->makePath(
            $config->getTestBasePath(),
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
     * @param SuiteConfig $config
     *
     * @return bool
     */
    private function isPhpClassFile($srcFile, $config)
    {
        return FileUtils::instance()->extensionIs($srcFile, 'php')
            && $this->fileHasClass(FileUtils::instance()->makePath($config->getSrcBasePath(), $srcFile));
    }
}