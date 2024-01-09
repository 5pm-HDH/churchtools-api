<?php

namespace CTApi\Test\Integration;

use CTApi\CTConfig;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Groups\Person\PersonRequest;
use PHPUnit\Framework\TestCase;

class TestCaseAuthenticated extends TestCase
{
    private static bool $configIsInitialized = false;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        if(self::$configIsInitialized) {
            try {
                PersonRequest::whoami();
            } catch(CTRequestException $exception) {
                self::reauthenticateChurchToolsUser();
            }
        }

        if (self::$configIsInitialized == false || self::cookieJarIsEmpty()) {
            self::reauthenticateChurchToolsUser();
        }
    }

    private static function cookieJarIsEmpty()
    {
        return empty(CTConfig::getSessionCookie());
    }

    protected static function reauthenticateChurchToolsUser()
    {
        CTConfig::clearConfig();        // clear config to prevent token from beeing stored
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());

        $auth = IntegrationTestData::get()->authenticateUser();
        self::$configIsInitialized = true;
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
