<?php


namespace Tests\Integration\Requests;


use CTApi\Models\Group;
use CTApi\Models\GroupMember;
use CTApi\Models\Person;
use CTApi\Requests\GroupRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class GroupMemberRequestTest extends TestCaseAuthenticated
{

    private string $groupId = "";
    private string $groupName = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("GROUP_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->groupId = TestData::getValue("GROUP_ID") ?? "";
            $this->groupName = TestData::getValue("GROUP_NAME") ?? "";
        }
    }

    public function testGetGroupMembers(): void
    {
        $myGroup = GroupRequest::find((int)$this->groupId);
        $this->assertNotNull($myGroup);
        $this->assertInstanceOf(Group::class, $myGroup);

        $firstMember = $myGroup->requestMembers()->get()[0];

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