<?php


namespace integration\Config;


use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Person;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\PersonRequest;
use PHPUnit\Framework\TestCase;
use Tests\Integration\IntegrationTestData;

class AuthWithLoginTokenTest extends TestCase
{
    protected function setUp(): void
    {
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
    }

    public function testInvalidLogin()
    {
        $this->expectException(CTAuthException::class);
        CTConfig::authWithLoginToken("invalidlogintoken");
    }

    public function testValidLoginToken()
    {
        $isAuth = CTConfig::validateAuthentication();
        $this->assertFalse($isAuth);

        $loginToken = $this->getLoginToken();
        CTConfig::authWithLoginToken($loginToken);

        $isAuth = CTConfig::validateAuthentication();
        $this->assertTrue($isAuth);

        $myself = PersonRequest::whoami();
        $this->assertNotNull($myself->getId());
        $this->assertTrue($myself->getIdAsInteger() > 0);
    }

    private function getLoginToken(): string
    {
        // Retrieve LoginToken
        IntegrationTestData::get()->authenticateUser();
        $myself = PersonRequest::whoami();
        $this->assertNotNull($myself->getId());
        $token = AuthRequest::retrieveApiToken($myself->getIdOrFail());
        $this->assertNotNull($token);

        // Reset CTConfig
        CTConfig::clearCookies();
        $isValidAuth = CTConfig::validateAuthentication();
        $this->assertFalse($isValidAuth, "AuthReset of CTConfig was not successful.");

        return $token;
    }
}