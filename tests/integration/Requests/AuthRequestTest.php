<?php

namespace Tests\Integration\Requests;

use CTApi\CTConfig;
use PHPUnit\Framework\TestCase;
use Tests\Integration\IntegrationTestData;

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

}
