<?php

namespace Tests\Integration\Config;

use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use PHPUnit\Framework\TestCase;
use Tests\Integration\IntegrationTestData;

class CTConfigIntegrationTest extends TestCase
{

    public function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testAuthWithCredentialsSuccessfully(): void
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = IntegrationTestData::get()->getApiUrl();

        CTConfig::setApiUrl($apiUrl);

        IntegrationTestData::get()->authenticateUser();
    }

    public function testAuthWithCredentialsFailing(): void
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = IntegrationTestData::get()->getApiUrl();
        CTConfig::setApiUrl($apiUrl);

        $wrongAuthEmail = "some.wrong.email@wrong-provider.com";
        $wrongAuthPassword = "wrongPassword";

        $exceptionIsThrown = false;
        try {
            CTConfig::authWithCredentials($wrongAuthEmail, $wrongAuthPassword);
        } catch (CTAuthException $e) {
            $exceptionIsThrown = true;
            $this->assertInstanceOf(CTAuthException::class, $e);
        }
        $this->assertTrue($exceptionIsThrown, "AuthException has not been thrown.");

    }
}
