<?php

use JimmyOak\PhpUnitChecker\Config\SuiteConfig;

class SuiteConfigTest extends \PHPUnit_Framework_TestCase
{
    const SRC_PATH = 'src/main/php';
    const TEST_PATH = 'src/test/php';
    const TEST_SUFFIX = 'TestCase';
    const BASE_PATH = './';

    const DEFAULT_SRC_PATH = 'src';
    const DEFAULT_TEST_PATH = 'test';
    const DEFAULT_TEST_SUFFIX = 'Test';

    /**
     * @test
     */
    public function shouldConstructAndGetValues()
    {
        $config = new SuiteConfig(self::SRC_PATH, self::TEST_PATH, self::TEST_SUFFIX, self::BASE_PATH);

        $this->assertSame(self::SRC_PATH, $config->getSrcPath());
        $this->assertSame(self::TEST_PATH, $config->getTestPath());
        $this->assertSame(self::TEST_SUFFIX, $config->getTestCaseSuffix());
        $this->assertSame(self::BASE_PATH . self::SRC_PATH, $config->getSrcBasePath());
        $this->assertSame(self::BASE_PATH . self::TEST_PATH, $config->getTestBasePath());
    }

    /**
     * @test
     */
    public function shouldSetDefaultValuesOnNullArguments()
    {
        $config = new SuiteConfig(null, null, null);

        $this->assertSame(self::DEFAULT_SRC_PATH, $config->getSrcPath());
        $this->assertSame(self::DEFAULT_TEST_PATH, $config->getTestPath());
        $this->assertSame(self::DEFAULT_TEST_SUFFIX, $config->getTestCaseSuffix());
        $this->assertSame(self::DEFAULT_SRC_PATH, $config->getSrcBasePath());
        $this->assertSame(self::DEFAULT_TEST_PATH, $config->getTestBasePath());
    }
}
