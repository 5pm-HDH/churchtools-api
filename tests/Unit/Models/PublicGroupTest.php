<?php


namespace CTApi\Test\Unit\Models;


use CTApi\CTConfig;
use CTApi\Models\Groups\PublicGroup\PublicGroup;
use PHPUnit\Framework\TestCase;

class PublicGroupTest extends TestCase
{

    public function testGenerateRegistrationLink()
    {
        // WITHOUT SLASH IN THE END OF URL
        CTConfig::setApiUrl("https://test.church.tools");

        $publicGroup = new PublicGroup();
        $publicGroup->setId("21");

        $this->assertEquals("https://test.church.tools/publicgroup/21?hash=EXAMPLEHASHCODE", $publicGroup->generateRegistrationLink("EXAMPLEHASHCODE"));

        // WITH SLASH IN THE END OF URL
        CTConfig::setApiUrl("https://test.church.tools/");

        $this->assertEquals("https://test.church.tools/publicgroup/21?hash=EXAMPLEHASHCODE", $publicGroup->generateRegistrationLink("EXAMPLEHASHCODE"));

    }
}