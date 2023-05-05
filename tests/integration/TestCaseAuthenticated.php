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
        self::reauthenticateChurchToolsUser();
    }

    protected static function reauthenticateChurchToolsUser()
    {
        CTConfig::clearConfig();        // clear config to prevent token from beeing stored
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());

        IntegrationTestData::get()->authenticateUser();
    }

    /**
     * Custom Assertions
     */

    protected function assertEqualsTestData(string $testCase, string $resultPath, $actual)
    {
        $value = IntegrationTestData::getResult($testCase, $resultPath);
        $this->assertEquals($value, $actual);
    }
}
