<?php

use CTApi\CTConfig;
use PHPUnit\Framework\TestCase;

class CTConfigTest extends TestCase
{

    public function testApiUrl()
    {
        $this->assertNull(CTConfig::getApiUrl());

        $exampleUrl = "http://api.church.tools/";
        CTConfig::setApiUrl($exampleUrl);

        $this->assertEquals($exampleUrl, CTConfig::getApiUrl());
    }

    public function testAuthWithCredentials()
    {
        $this->assertNull(CTConfig::getApiKey());

        $apiUrl = TestData::getValue("API_URL");

        CTConfig::setApiUrl($apiUrl);

        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");

        CTConfig::authWithCredentials($authEmail, $authPassword);

        $this->assertNotNull(CTConfig::getApiKey());

    }
}