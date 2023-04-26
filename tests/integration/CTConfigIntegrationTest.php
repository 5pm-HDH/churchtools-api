<?php

namespace Tests\Integration;

use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\AuthRequestBuilder;
use PHPUnit\Framework\TestCase;

class CTConfigIntegrationTest extends TestCase
{

    public function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testAuthWithCredentialsSuccessfully(): void
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = TestData::getValue("API_URL");

        CTConfig::setApiUrl($apiUrl);

        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");

        CTConfig::authWithCredentials($authEmail, $authPassword);
    }

    public function testAuthWithCredentialsFailing(): void
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = TestData::getValue("API_URL");
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

    public function testValidateApiKey(): void
    {
        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");
        $apiUrl = TestData::getValue("API_URL");

        CTConfig::setApiUrl($apiUrl);
        $auth = CTConfig::authWithCredentials($authEmail, $authPassword);

        $apiKey = AuthRequest::retrieveApiToken($auth->userId);

        //set false API-Key
        CTConfig::setApikey("notvalid-api-key");
        CTConfig::clearCookies();
        $this->assertFalse(CTConfig::validateAuthentication());

        //set working API-Key
        $this->assertNotNull($apiKey);
        CTConfig::setApiKey($apiKey);
        $this->assertTrue(CTConfig::validateAuthentication());
    }
}
