<?php


namespace CTApi\Test\Unit;


use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\CTSession;

class CTSessionUnitTest extends TestCaseHttpMocked
{
    protected function setUp(): void
    {
        parent::setUp();
        CTSession::clearSessions();
    }

    public function testSwitchSession()
    {
        $configDefault = CTConfig::getConfig();
        $clientDefault = CTClient::getClient();

        CTSession::switchSession("person_b");

        $configPerson = CTConfig::getConfig();
        $clientPerson = CTClient::getClient();

        CTSession::switchSession();

        $configDefaultB = CTConfig::getConfig();
        $clientDefaultB = CTClient::getClient();

        CTSession::switchSession("default");

        $configDefaultC = CTConfig::getConfig();
        $clientDefaultC = CTClient::getClient();

        $this->assertNotEquals($configDefault, $configPerson);
        $this->assertNotEquals($clientDefault, $clientPerson);
        $this->assertEquals($configDefault, $configDefaultB);
        $this->assertEquals($clientDefault, $clientDefaultB);
        $this->assertEquals($configDefault, $configDefaultC);
        $this->assertEquals($clientDefault, $clientDefaultC);

        $sessionIds = CTSession::getSessionIds();

        $this->assertTrue(in_array("default", $sessionIds));
        $this->assertTrue(in_array("person_b", $sessionIds));
    }

    public function testSessionDefault()
    {
        $sessionIds = CTSession::getSessionIds();

        $this->assertEquals(1, sizeof($sessionIds));
        $this->assertTrue(in_array("default", $sessionIds));
    }
}