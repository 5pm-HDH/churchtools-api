<?php

use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTConfigException;
use PHPUnit\Framework\TestCase;

class CTConfigTest extends TestCase
{

    public function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function fillConfigWithExampleData()
    {
        CTConfig::setApiUrl("https://example.com/api");
    }

    public function testApiUrl()
    {
        $this->assertNull(CTConfig::getApiUrl());

        $exampleUrl = "https://api.church.tools/";
        CTConfig::setApiUrl($exampleUrl);

        $this->assertEquals($exampleUrl, CTConfig::getApiUrl());
    }

    public function testValidateConfig()
    {
        // INVALID CONFIG
        $exceptionThrown = false;
        try {
            CTConfig::validateConfig();
        } catch (CTConfigException) {
            $exceptionThrown = true;
        }
        $this->assertTrue($exceptionThrown);

        CTConfig::setApiUrl("https://example.com/api");

        // VALID CONFIG
        $exceptionThrown = false;
        try {
            CTConfig::validateConfig();
        } catch (CTConfigException) {
            $exceptionThrown = true;
        }
        $this->assertFalse($exceptionThrown);
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

    public function testAuthWithCredentialsFailingBecauseApiUrlIsEmpty()
    {
        $this->assertNull(CTConfig::getApiUrl());

        //that are the right credentials
        $authEmail = "some@thing.gg";
        $authPassword = "s3cur3";

        $exceptionThrown = false;
        try {
            CTConfig::authWithCredentials($authEmail, $authPassword);
        } catch (CTConfigException) {
            $exceptionThrown = true; // Auth is invalid, because API-Url must be set
        }
        $this->assertTrue($exceptionThrown);
    }

    public function testDebuggingMode()
    {
        $this->fillConfigWithExampleData();

        CTConfig::enableDebugging();
        $requestConfig = CTConfig::getRequestConfig();
        $this->assertTrue($requestConfig['debug']);


        CTConfig::disableDebugging();
        $requestConfig = CTConfig::getRequestConfig();
        $this->assertFalse($requestConfig['debug']);
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
