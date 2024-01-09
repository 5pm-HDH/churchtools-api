<?php

namespace CTApi\Test\Integration\Config;

use CTApi\CTConfig;
use CTApi\Exceptions\CTConfigException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Test\Integration\IntegrationTestData;
use PHPUnit\Framework\TestCase;

class TwoFactorAuthenticationTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
    }

    public function testUserWithoutMultiFactorAuthentication()
    {
        $auth = IntegrationTestData::get()->authenticateUser();
        $this->assertFalse($auth->requireMultiFactorAuthentication);
    }

    public function testWithoutTotpCode()
    {
        $this->expectException(CTConfigException::class);
        $auth = IntegrationTestData::get()->authenticateUser("ignatius");
    }

    public function testWithWrongTotpCode()
    {
        $this->expectException(CTRequestException::class);
        $auth = IntegrationTestData::get()->authenticateUser("ignatius", "000000");
    }

    /**
     * Used to test the TOTP-mechanism localy. To do so set the isProduction flag to false.
     * @param string $totpCode
     * @param bool $isProduction
     */
    public function testWithRightTotpCode($totpCode = "709888", $isProduction = true)
    {
        if ($isProduction) {
            $this->markTestSkipped("Cannot test Multi-factor authentifcation on integration system.");
        }
        $auth = IntegrationTestData::get()->authenticateUser("ignatius", $totpCode);

        $this->assertTrue($auth->requireMultiFactorAuthentication);

        $groups = GroupRequest::all();
        $this->assertFalse(empty($groups));
    }

}
