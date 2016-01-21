<?php

namespace JimmyOak\Test\PhpUnitChecker\Config;

use JimmyOak\PhpUnitChecker\Config\JsonConfigReader;
use JimmyOak\PhpUnitChecker\Config\SuiteConfig;

class JsonConfigReaderTest extends \PHPUnit_Framework_TestCase
{
    const JSON_CONFIG = '{
  "suites": [
    {
      "src-path": "src",
      "test-path": "test",
      "test-case-suffix": "Test"
    },
    {
      "src-path": "another-src",
      "test-path": "another-test",
      "test-case-suffix": "AnotherTest"
    }
  ]
}';


    /**
     * @test
     */
    public function shouldGenerateConfigFromJson()
    {
        /** @var SuiteConfig[] $config */
        $config = JsonConfigReader::read(self::JSON_CONFIG);

        $this->assertConfig($config);
    }

    /**
     * @test
     */
    public function shouldGenerateConfigFromJsonFile()
    {
        $config = JsonConfigReader::readFile(__DIR__ . '/Value/config.json');

        $this->assertConfig($config);
    }

    /**
     * @param $config
     */
    private function assertConfig($config)
    {
        $this->assertCount(2, $config);

        $this->assertSame('src', $config[0]->getSrcPath());
        $this->assertSame('test', $config[0]->getTestPath());
        $this->assertSame('Test', $config[0]->getTestCaseSuffix());

        $this->assertSame('another-src', $config[1]->getSrcPath());
        $this->assertSame('another-test', $config[1]->getTestPath());
        $this->assertSame('AnotherTest', $config[1]->getTestCaseSuffix());
    }
}
