<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Models\GroupMember;
use CTApi\Requests\GroupMemberRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class GroupUpdateRequestTest extends TestCaseAuthenticated
{
    private int $groupId;
    private int $personId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkIfTestSuiteIsEnabled("GROUP_MEMBER_UPDATE");
        $this->groupId = TestData::getValueAsInteger("GROUP_MEMBER_UPDATE_GROUP_ID");
        $this->personId = TestData::getValueAsInteger("GROUP_MEMBER_UPDATE_PERSON_ID");

        // Add Person to Group
        GroupMemberRequest::addMember($this->groupId, $this->personId);
        $this->assertPersonIsGroupMember(true);
    }

    private function assertPersonIsGroupMember(bool $expectAsGroupMember): ?GroupMember
    {
        $groupMember = GroupMemberRequest::get($this->groupId)->get();
        $foundGroupMember = null;
        foreach ($groupMember as $groupMember) {
            if (is_a($groupMember, GroupMember::class)) {
                if ($groupMember->getPersonId() == $this->personId) {
                    $foundGroupMember = $groupMember;
                }
            }
        }
        if ($expectAsGroupMember) {
            $this->assertNotNull($foundGroupMember, "Could not found person #" . $this->personId . " in group #" . $this->groupId);
        } else {
            $this->assertNull($foundGroupMember, "Found person #" . $this->personId . " in group #" . $this->groupId . " but expected not to be member.");
        }
        return $foundGroupMember;
    }

    public function testRemoveAndAddPerson()
    {
        // Remove
        GroupMemberRequest::removeMember($this->groupId, $this->personId);
        $this->assertPersonIsGroupMember(false);

        // Add Person
        $groupMember = GroupMemberRequest::addMember($this->groupId, $this->personId);

        $this->assertEquals($this->personId, $groupMember->getPersonId());
        $today = date("Y-m-d");
        $this->assertEquals($today, $groupMember->getMemberStartDate());
    }

    public function testUpdateGroupMemberFields()
    {
        CTConfig::enableDebugging();
        $groupMember = $this->assertPersonIsGroupMember(true);
        $this->assertNotNull($groupMember);

        /**
         * First Update
         */
        $groupMember->setComment("New Member");
        $lastMonth = date("Y-m-d", strtotime("- 1 Month"));
        $nextMonth = date("Y-m-d", strtotime("+ 1 Month"));

        $groupMember->setMemberStartDate($lastMonth);
        $groupMember->setMemberEndDate($nextMonth);

        // Update
        GroupMemberRequest::updateMember($this->groupId, $groupMember);
        $groupMemberReloaded = $this->assertPersonIsGroupMember(true);
        $this->assertNotNull($groupMemberReloaded);

        $this->assertEquals("New Member", $groupMemberReloaded->getComment());
        $this->assertEquals($lastMonth, $groupMemberReloaded->getMemberStartDate());
        $this->assertEquals($nextMonth, $groupMemberReloaded->getMemberEndDate());

        /**
         * Second Update
         */
        $groupMember->setComment("Old Member");
        $lastYear = date("Y-m-d", strtotime("- 1 Year"));
        $nextYear = date("Y-m-d", strtotime("+ 1 Year"));

        $groupMember->setMemberStartDate($lastYear);
        $groupMember->setMemberEndDate($nextYear);

        // Update
        GroupMemberRequest::updateMember($this->groupId, $groupMember);
        $groupMemberReloaded = $this->assertPersonIsGroupMember(true);
        $this->assertNotNull($groupMemberReloaded);

        $this->assertEquals("Old Member", $groupMemberReloaded->getComment());
        $this->assertEquals($lastYear, $groupMemberReloaded->getMemberStartDate());
        $this->assertEquals($nextYear, $groupMemberReloaded->getMemberEndDate());
    }
}