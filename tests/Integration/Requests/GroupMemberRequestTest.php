<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Groups\Group\Group;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Models\Groups\GroupMember\GroupMember;
use CTApi\Models\Groups\Person\Person;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class GroupMemberRequestTest extends TestCaseAuthenticated
{
    private string $groupId = "";

    protected function setUp(): void
    {
        $this->groupId = IntegrationTestData::getFilter("get_group", "id");
    }

    public function testGetGroupMembers(): void
    {
        $myGroup = GroupRequest::find((int)$this->groupId);
        $this->assertNotNull($myGroup);
        $this->assertInstanceOf(Group::class, $myGroup);

        $memberBuilder = $myGroup->requestMembers();
        $this->assertNotNull($memberBuilder);
        $firstMember = $memberBuilder->get()[0];

        $this->assertNotNull($firstMember->getPerson());
        $this->assertInstanceOf(Person::class, $firstMember->getPerson());

        $firstPerson = $firstMember->requestPerson();
        $this->assertNotNull($firstPerson);
        $this->assertInstanceOf(Person::class, $firstPerson);
    }

    public function testEmptyGroupMember(): void
    {
        $emptyGroupMember = GroupMember::createModelFromData([]);

        $this->assertNull($emptyGroupMember->getPerson());
        $this->assertNull($emptyGroupMember->requestPerson());
    }

}
