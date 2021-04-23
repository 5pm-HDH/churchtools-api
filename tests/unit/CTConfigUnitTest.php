<?php

use CTApi\CTConfig;
use CTApi\Exceptions\CTConfigException;
use PHPUnit\Framework\TestCase;

class CTConfigUnitTest extends TestCase
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
}
