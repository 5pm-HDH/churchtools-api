<?php

namespace CTApi\Test\Unit;

use CTApi\CTConfig;
use CTApi\Exceptions\CTConfigException;
use CTApi\Middleware\CTCacheMiddleware;
use PHPUnit\Framework\TestCase;

class CTConfigUnitTest extends TestCase
{

    public function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function fillConfigWithExampleData(): void
    {
        CTConfig::setApiUrl("https://example.com/api");
    }

    public function testApiUrl(): void
    {
        $this->assertNull(CTConfig::getApiUrl());

        $exampleUrl = "https://api.church.tools/";
        CTConfig::setApiUrl($exampleUrl);

        $this->assertEquals($exampleUrl, CTConfig::getApiUrl());
    }

    public function testValidateConfig(): void
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

    public function testAuthWithCredentialsFailingBecauseApiUrlIsEmpty(): void
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

    public function testCacheTimeToLive(): void
    {
        CTConfig::enableCache();
        $this->assertNotNull(CTCacheMiddleware::getTimeToLive());

        CTConfig::enableCache(291);
        $this->assertEquals(291, CTCacheMiddleware::getTimeToLive());
    }
}
