<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTConfig;
use CTApi\Requests\AuthRequest;
use PHPUnit\Framework\TestCase;
use CTApi\Test\Integration\IntegrationTestData;

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
