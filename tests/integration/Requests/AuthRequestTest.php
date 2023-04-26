<?php

namespace Tests\Integration\Requests;

use CTApi\CTConfig;
use CTApi\Requests\AuthRequest;
use PHPUnit\Framework\TestCase;
use Tests\Integration\TestData;

class AuthRequestTest extends TestCase
{

    public function setUp(): void
    {
        $apiUrl = TestData::getValue("API_URL");
        CTConfig::setApiUrl($apiUrl);
    }


    public function testAuthWithEmailAndPassword(): void
    {
        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");

        $auth = AuthRequest::authWithEmailAndPassword($authEmail, $authPassword);
        $this->assertNotNull($auth->userId);

        $authUserId = TestData::getValue("AUTH_USER_ID");
        $this->assertEquals($authUserId, $auth->userId);

        $cookie = CTConfig::getSessionCookie();
        $this->assertNotNull($cookie);
    }

}
