<?php

namespace Tests\Integration;

use CTApi\CTConfig;
use PHPUnit\Framework\TestCase;

class TestCaseAuthenticated extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        CTConfig::setApiUrl(TestData::getValue('API_URL'));
        CTConfig::authWithCredentials(
            TestData::getValue('AUTH_EMAIL'),
            TestData::getValue('AUTH_PASSWORD')
        );
    }

    protected function checkIfTestSuiteIsEnabled(string $testsuite)
    {
        if (!TestData::getValue($testsuite) == "YES") {
            $this->markTestSkipped("Test suite " . $testsuite . " is disabled in testdata.ini");
        }
    }
}
