<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\Group;
use CTApi\Models\GroupMember;
use CTApi\Models\Person;
use CTApi\Requests\GroupRequest;
use CTApi\Test\Integration\IntegrationTestData;


use CTApi\Test\Integration\TestCaseAuthenticated;

class GroupMemberRequestTest extends TestCaseAuthenticated
{

    private string $groupId = "";
    private string $groupName = "";

    protected function setUp(): void
    {
        $this->groupId = IntegrationTestData::getFilter("get_group", "id");
        $this->groupName = IntegrationTestData::getResult("get_group", "name");

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