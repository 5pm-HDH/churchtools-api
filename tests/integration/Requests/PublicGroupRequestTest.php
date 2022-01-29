<?php


namespace Tests\Integration\Requests;


use CTApi\Requests\PublicGroupRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class PublicGroupRequestTest extends TestCaseAuthenticated
{

    private $publicGroupHash = "";
    private $groupId = "";
    private $groupName = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("PUBLIC_GROUP_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->publicGroupHash = TestData::getValue("PUBLIC_GROUP_HASH");
            $this->groupId = TestData::getValue("PUBLIC_GROUP_ID");
            $this->groupName = TestData::getValue("PUBLIC_GROUP_NAME");
        }
    }

    public function testGetPublicGroup()
    {
        $publicGroup = PublicGroupRequest::get($this->publicGroupHash);

        $foundGroup = null;
        foreach ($publicGroup->getGroups() as $group) {
            if ($group->getId() == $this->groupId) {
                $foundGroup = $group;
            }
        }

        print_r($foundGroup);

        $this->assertNotNull($foundGroup);
        $this->assertEquals($this->groupName, $foundGroup->getName());
    }

}