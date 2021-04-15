<?php


use CTApi\CTConfig;
use CTApi\Requests\AuthRequest;
use PHPUnit\Framework\TestCase;

class AuthRequestTest extends TestCase
{

    public function setUp(): void
    {
        $apiUrl = TestData::getValue("API_URL");
        CTConfig::setApiUrl($apiUrl);
    }


    public function testAuthWithEmailAndPassword()
    {
        $authEmail = TestData::getValue("AUTH_EMAIL");
        $authPassword = TestData::getValue("AUTH_PASSWORD");

        $auth = AuthRequest::authWithEmailAndPassword($authEmail, $authPassword);

        $this->assertNotNull($auth->apiKey);
        $this->assertNotNull($auth->userId);

        $authUserId = TestData::getValue("AUTH_USER_ID");
        $this->assertEquals($authUserId, $auth->userId);
    }

}
