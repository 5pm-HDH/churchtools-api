<?php

use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTConfigException;
use PHPUnit\Framework\TestCase;

class CTConfigIntegrationTest extends TestCase
{

    public function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testAuthWithCredentialsSuccessfully()
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = TestData::getValue("API_URL");

        CTConfig::setApiUrl($apiUrl);

        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");

        CTConfig::authWithCredentials($authEmail, $authPassword);

        $this->assertNotNull(CTConfig::getApiKey());

    }

    public function testAuthWithCredentialsFailing()
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

    public function testValidateApiKey()
    {

        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");
        $apiUrl = TestData::getValue("API_URL");

        CTConfig::setApiUrl($apiUrl);
        CTConfig::authWithCredentials($authEmail, $authPassword);

        $apiKey = CTConfig::getApiKey();

        //set false API-Key
        CTConfig::setApikey("notvalid-api-key");
        CTConfig::clearCookies();
        $this->assertFalse(CTConfig::validateApiKey());

        //set working API-Key
        CTConfig::setApiKey($apiKey);
        $this->assertTrue(CTConfig::validateApiKey());
    }
}
