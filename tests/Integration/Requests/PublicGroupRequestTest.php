<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\GroupInformation;
use CTApi\Models\TargetGroup;
use CTApi\Requests\PublicGroupRequest;
use CTApi\Test\Integration\IntegrationTestData;


use CTApi\Test\Integration\TestCaseAuthenticated;

class PublicGroupRequestTest extends TestCaseAuthenticated
{

    private $publicGroupHash = "";
    private $groupId = "";
    private $groupName = "";
    private $targetGroupName = "";

    protected function setUp(): void
    {
        $this->publicGroupHash = IntegrationTestData::getFilter("load_public_group", "hash");

        $this->groupId = IntegrationTestData::getResult("load_public_group", "any_group.id");
        $this->groupName = IntegrationTestData::getResult("load_public_group", "any_group.name");
        $this->targetGroupName = IntegrationTestData::getResult("load_public_group", "any_group.target_group_name");
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

        $this->assertNotNull($foundGroup->getInformation()->getTargetGroup());
        $this->assertInstanceOf(TargetGroup::class, $foundGroup->getInformation()->getTargetGroup());
        $this->assertEquals($this->targetGroupName, $foundGroup->getInformation()->getTargetGroup()->getName());

        $this->assertNotNull($foundGroup->getInformation()->getGroupPlaces());
        $this->assertIsArray($foundGroup->getInformation()->getGroupPlaces());
    }

    public function testGetPublicGroupImages()
    {
        $publicGroup = PublicGroupRequest::get($this->publicGroupHash);
        $foundGroup = null;
        foreach ($publicGroup->getGroups() as $group) {
            if ($group->getId() == $this->groupId) {
                $foundGroup = $group;
            }
        }

        $groupInformation = $foundGroup?->getInformation();

        $this->assertNotNull($groupInformation);

        $imageSmall = $groupInformation->getImageUrl();
        $imageWide = $groupInformation->getImageUrlBanner();

        $this->assertNotNull($imageSmall);
        $this->assertNotNull($imageWide);
    }
}