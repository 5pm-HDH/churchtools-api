<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTConfig;
use CTApi\Models\Common\Auth\AuthRequest;
use CTApi\Test\Integration\IntegrationTestData;
use PHPUnit\Framework\TestCase;

class AuthRequestTest extends TestCase
{
    public function setUp(): void
    {
        $apiUrl = IntegrationTestData::get()->getApiUrl();
        CTConfig::setApiUrl($apiUrl);
    }


    public function testAuthWithEmailAndPassword(): void
    {
        $auth = IntegrationTestData::get()->authenticateUser();
        $this->assertNotNull($auth->userId);

        $authUserId = IntegrationTestData::getResult("auth", "person_id");
        $this->assertEquals($authUserId, $auth->userId);

        $cookie = CTConfig::getSessionCookie();
        $this->assertNotNull($cookie);
    }

    public function testAuthWithSessionCookie(): void
    {
        $auth = IntegrationTestData::get()->authenticateUser();
        $userId = $auth->userId;
        $this->assertNotNull($userId);

        $cookie = CTConfig::getSessionCookieString();
        $this->assertNotNull($cookie);

        // clear config
        CTConfig::clearConfig();
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());

        // verify that we are not logged in now
        $this->assertNull(CTConfig::getSessionCookieString());

        // login using the cookie
        $auth = CTConfig::authWithSessionCookie($cookie);
        $this->assertEquals($userId, $auth->userId);
        $this->assertTrue(CTConfig::validateAuthentication());

        // confirm we are still logged in
        $authValid = CTConfig::validateAuthentication();
        $this->assertTrue($authValid);

        // confirm the session cookie was updated (but not replaced)
        $updatedCookie = CTConfig::getSessionCookieString();
        $this->assertSame(explode(';', $cookie, 2)[0], explode(';', $updatedCookie, 2)[0]);
    }

    public function testAuthWithUserIdAndLoginToken()
    {
        $auth = IntegrationTestData::get()->authenticateUser();
        $apiToken = AuthRequest::retrieveApiToken($auth->userId);
        $this->assertNotNull($apiToken);

        // Recreate Config
        CTConfig::clearConfig();
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());

        $success = CTConfig::authWithUserIdAndLoginToken($auth->userId, $apiToken);
        $this->assertTrue($success);

        $authValid = CTConfig::validateAuthentication();
        $this->assertTrue($authValid);
    }

    public function testAuthWithUserIdAndLoginTokenFailing()
    {
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
        $success = CTConfig::authWithUserIdAndLoginToken(IntegrationTestData::getResult("auth", "person_id"), "invalid token");

        $this->assertFalse($success);
    }

}
