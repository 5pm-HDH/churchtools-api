<?php


namespace Tests\Integration\Requests;


use CTApi\Models\GroupCategory;
use CTApi\Models\GroupInformation;
use CTApi\Models\GroupPlaces;
use CTApi\Models\TargetGroup;
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

        $this->assertNotNull($foundGroup);
        $this->assertEquals($this->groupName, $foundGroup->getName());

        $this->assertNotNull($foundGroup->getInformation());
        $this->assertInstanceOf(GroupInformation::class, $foundGroup->getInformation());

        $this->assertNotNull($foundGroup->getInformation()->getGroupCategory());
        $this->assertInstanceOf(GroupCategory::class, $foundGroup->getInformation()->getGroupCategory());

        $this->assertNotNull($foundGroup->getInformation()->getTargetGroup());
        $this->assertInstanceOf(TargetGroup::class, $foundGroup->getInformation()->getTargetGroup());

        $this->assertNotNull($foundGroup->getInformation()->getGroupPlaces());
        $this->assertInstanceOf(GroupPlaces::class, $foundGroup->getInformation()->getGroupPlaces());
    }

}