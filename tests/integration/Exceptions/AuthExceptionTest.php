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

    public function testWrongEmail(): void
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials("wrong-email@fail.com", "wrongPassword");
    }

    public function testWrongPassword(): void
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials(TestData::getValue("AUTH_EMAIL"), "wrongPassword");
    }

    public function testSuccessfulAuth(): void
    {
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::authWithCredentials(TestData::getValue("AUTH_EMAIL"), TestData::getValue("AUTH_PASSWORD"));
        $this->assertNotNull(PersonRequest::whoami());
    }

    public function testWrongApiKey(): void
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(TestData::getValue("API_URL"));
        CTConfig::setApiKey("wrong-api-key");
        $person = PersonRequest::whoami();
    }
}