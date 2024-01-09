<?php

namespace CTApi\Test\Integration\Config;

use CTApi\CTConfig;
use CTApi\CTSession;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;
use PHPUnit\Framework\TestCase;

class CTSessionIntegrationTest extends TestCase
{
    public function testSwitchSession()
    {
        // Default Session
        $this->configPersonA();
        $personA = PersonRequest::whoami();

        // Custom Session
        CTSession::switchSession("custom_person_session");
        $this->configPersonB();
        $personB = PersonRequest::whoami();

        // Default Session
        CTSession::switchSession();
        $personA_2 = PersonRequest::whoami();

        // Custom Session
        CTSession::switchSession("custom_person_session");
        $personB_2 = PersonRequest::whoami();

        $this->assertEquals($personA, $personA_2);
        $this->assertEquals($personB, $personB_2);
        $this->assertNotEquals($personA, $personB);
        $this->assertNotEquals($personA_2, $personB_2);
        $this->assertNotEquals($personA, $personB_2);
        $this->assertNotEquals($personA_2, $personB);
    }

    private function configPersonA()
    {
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
        IntegrationTestData::get()->authenticateUser();
    }

    private function configPersonB()
    {
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
        IntegrationTestData::get()->authenticateUser("jona");
    }

}
