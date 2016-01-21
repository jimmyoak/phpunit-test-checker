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
        $basePath = __DIR__ . '/Value/';
        $config = JsonConfigReader::readFile($basePath . 'config.json');

        $this->assertConfig($config, $basePath);
    }

    /**
     * @param $config
     * @param $basePath
     */
    private function assertConfig($config, $basePath = '')
    {
        $this->assertCount(2, $config);

        $this->assertSame('src', $config[0]->getSrcPath());
        $this->assertSame('test', $config[0]->getTestPath());
        $this->assertSame($basePath . 'src', $config[0]->getSrcBasePath());
        $this->assertSame($basePath . 'test', $config[0]->getTestBasePath());
        $this->assertSame('Test', $config[0]->getTestCaseSuffix());

        $this->assertSame('another-src', $config[1]->getSrcPath());
        $this->assertSame('another-test', $config[1]->getTestPath());
        $this->assertSame($basePath . 'another-src', $config[1]->getSrcBasePath());
        $this->assertSame($basePath . 'another-test', $config[1]->getTestBasePath());
        $this->assertSame('AnotherTest', $config[1]->getTestCaseSuffix());
    }
}
