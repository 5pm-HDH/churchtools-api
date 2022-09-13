<?php

namespace Tests\Integration;

use CTApi\CTConfig;
use PHPUnit\Framework\TestCase;

class TestCaseAuthenticated extends TestCase
{
    private static ?string $apiToken = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if (
            is_null(self::$apiToken)                        // token is not set
            || CTConfig::getApiKey() != self::$apiToken     // token is corrupt
        ) {
            self::reauthenticateChurchToolsUser();
        }
    }

    protected static function reauthenticateChurchToolsUser()
    {
        CTConfig::clearConfig();        // clear config to prevent token from beeing stored
        CTConfig::setApiUrl(TestData::getValue('API_URL'));
        CTConfig::authWithCredentials(
            TestData::getValue('AUTH_EMAIL'),
            TestData::getValue('AUTH_PASSWORD')
        );
        self::$apiToken = CTConfig::getApiKey();
    }

    protected function checkIfTestSuiteIsEnabled(string $testsuite)
    {
        if (!TestData::getValue($testsuite) == "YES") {
            $this->markTestSkipped("Test suite " . $testsuite . " is disabled in testdata.ini");
        }
    }
}
