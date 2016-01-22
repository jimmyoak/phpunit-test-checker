<?php

namespace JimmyOak\Test\PhpUnitChecker\Checker;

use JimmyOak\PhpUnitChecker\Checker\Checker;
use JimmyOak\PhpUnitChecker\Config\SuiteConfig;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldThrowExceptionWhenClassesWithNoTest()
    {
        $this->setExpectedException('\RuntimeException', "Classes with no tests:\n\t- NoTest/NonTestedClass.php");

        $checker = new Checker(array(
            new SuiteConfig(
                __DIR__ . '/Value/src',
                __DIR__ . '/Value/test',
                'Test',
                '',
                array(
                    'Excluded/'
                )
            )
        ));
        $checker->check();
    }

    /**
     * @test
     */
    public function shouldFinishWithNoExceptionWhenAllClasesAreTested()
    {
        $checker = new Checker(array(
            new SuiteConfig(
                __DIR__ . '/Value/src',
                __DIR__ . '/Value/test',
                'Test',
                '',
                array(
                    'Excluded/',
                    'NoTest/',
                )
            )
        ));

        $this->assertNull($checker->check());
    }
}
