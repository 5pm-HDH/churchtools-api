<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\CTLog;
use CTApi\Models\Group;
use CTApi\Models\GroupRole;
use CTApi\Models\GroupSettings;
use CTApi\Requests\GroupRequest;
use CTApi\Test\Integration\IntegrationTestData;


use CTApi\Test\Integration\TestCaseAuthenticated;

class GroupRequestTest extends TestCaseAuthenticated
{

    private string $groupId = "";
    private string $groupName = "";

    protected function setUp(): void
    {
        $this->groupId = IntegrationTestData::getFilter("get_group", "id");
        $this->groupName = IntegrationTestData::getResult("get_group", "name");
    }

    public function testGetAllGroups(): void
    {
        $allGroups = GroupRequest::all();

        $foundMyGroup = false;
        foreach ($allGroups as $group) {
            $this->assertInstanceOf(Group::class, $group);
            if ($group->getId() == $this->groupId) {
                $foundMyGroup = true;
            }
        }
        $this->assertTrue($foundMyGroup);
    }

    public function testGetGroup(): void
    {
        $myGroup = GroupRequest::find((int)$this->groupId);
        $this->assertNotNull($myGroup);
        $this->assertInstanceOf(Group::class, $myGroup);
        $this->assertEquals($myGroup->getName(), $this->groupName);

        $this->assertNotNull($myGroup->getRoles());
        $this->assertNotEmpty($myGroup->getRoles());

        $firstGroupRole = $myGroup->getRoles()[0];
        $this->assertInstanceOf(GroupRole::class, $firstGroupRole);

        $this->assertNotNull($myGroup->getSettings());
        $this->assertInstanceOf(GroupSettings::class, $myGroup->getSettings());
    }

    public function testCreateEmptyGroup(): void
    {
        $myGroup = Group::createModelFromData([]);
        $this->assertInstanceOf(Group::class, $myGroup);
        $this->assertNull($myGroup->getId());
    }

}