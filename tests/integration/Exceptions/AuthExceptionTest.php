<?php


use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Requests\PersonRequest;
use PHPUnit\Framework\TestCase;
use Tests\Integration\TestData;

class AuthExceptionTest extends TestCase
{
    protected function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testWrongEmail()
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials("wrong-email@fail.com", "wrongPassword");
    }

    public function testWrongPassword()
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials(TestData::getValue("AUTH_EMAIL"), "wrongPassword");
    }

    public function testSuccessfulAuth()
    {
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials(TestData::getValue("AUTH_EMAIL"), TestData::getValue("AUTH_PASSWORD"));
        $this->assertNotNull(PersonRequest::whoami());
    }

    public function testWrongApiKey()
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::setApiKey("wrong-api-key");
        $person = PersonRequest::whoami();
    }
}