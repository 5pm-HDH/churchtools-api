<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Groups\GroupMember\GroupMemberRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class GroupMemberUpdateRequestTest extends TestCaseHttpMocked
{

    /**
     * @doesNotPerformAssertions
     */
    public function testAddGroupMember()
    {
        $groupId = 21;
        $personId = 221;

        // Create Group-Membership
        $groupMember = GroupMemberRequest::addMember($groupId, $personId);

        // Update Group-Membership
        $groupMember->setComment("Add User via CT-Api.");
        $groupMember->setFields([]);
        $groupMember->setGroupTypeRoleId("21");
        $groupMember->setMemberEndDate("2040-01-01");
        $groupMember->setMemberStartDate("2020-01-01");
        $groupMember->setWaitinglistPosition("22");

        GroupMemberRequest::updateMember($groupId, $groupMember);

        // Delete Group-Membership
        GroupMemberRequest::removeMember($groupId, $personId);
    }

}