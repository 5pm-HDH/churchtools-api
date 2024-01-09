<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;
use Tests\Unit\TestCaseDocExampleCode;

class GroupRequestTest extends TestCaseHttpMocked
{
    public function testDocExample()
    {
        /**
         * Group-Request
         */

        // Retrieve all groups
        $allGroups = GroupRequest::all();
        $allGroups = GroupRequest::orderBy('name')->get();

        $myGroups = PersonRequest::whoami()->requestGroups();

        // Get specific Group
        $group = GroupRequest::find(21);     // returns "null" if id is invalid
        $group = GroupRequest::findOrFail(21); // throws exception if id is invalid


        /**
         * Group-Data
         */
        $this->assertEquals(21, $group->getId());
        $this->assertEquals("g21", $group->getGuid());
        $this->assertEquals("Sermon Group", $group->getName());
        $this->assertEquals("High", $group->getSecurityLevelForGroup());
        $this->assertEquals([], $group->getPermissions());
        $this->assertEquals([], $group->getFollowUp());
        $this->assertEquals("Admin", $group->getRoles()[0]->getName());

        // GroupHierarchie
        $childGroups = $group->requestGroupChildren()?->get();
        $parentGroups = $group->requestGroupParents()?->get();

        // GroupInformation
        $groupInformation = $group->getInformation();
        $this->assertEquals(null, $groupInformation?->getImageUrl());
        $this->assertEquals(null, $groupInformation?->getGroupHomepageUrl());
        $this->assertEquals(1, $groupInformation?->getGroupStatusId());
        $this->assertEquals(2, $groupInformation?->getGroupTypeId());
        $this->assertEquals("1903-02-12", $groupInformation?->getDateOfFoundation());
        $this->assertEquals("1903-02-12 00:00:00", $groupInformation?->getDateOfFoundationAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $groupInformation?->getEndDate());
        $this->assertEquals(null, $groupInformation?->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("17:00", $groupInformation?->getMeetingTime());
        $this->assertEquals(3, $groupInformation?->getGroupCategoryId());

        $ageGroupIdList = implode("/", $groupInformation?->getAgeGroupIds());
        $this->assertEquals("1/8", $ageGroupIdList);
        $this->assertEquals(2, $groupInformation?->getTargetGroupId());
        $this->assertEquals(200, $groupInformation?->getMaxMembers());
        $this->assertEquals("Hello World Note", $groupInformation?->getNote());
        $this->assertEquals(null, $groupInformation?->getCampusId());
        $this->assertEquals("NOT_STARTED", $groupInformation?->getChatStatus());
        $this->assertEquals(null, $groupInformation?->getSignUpOverrideRoleId());

        // GroupSettings;
        $this->assertEquals(false, $group->getSettings()?->getIsHidden());
        $this->assertEquals(true, $group->getSettings()?->getIsOpenForMembers());
        $this->assertEquals(true, $group->getSettings()?->getAllowSpouseRegistration());
        $this->assertEquals(true, $group->getSettings()?->getAllowChildRegistration());
        $this->assertEquals(true, $group->getSettings()?->getAllowSameEmailRegistration());
        $this->assertEquals(true, $group->getSettings()?->getAutoAccept());
        $this->assertEquals(true, $group->getSettings()?->getAllowWaitinglist());
        $this->assertEquals(21, $group->getSettings()?->getWaitinglistMaxPersons());
        $this->assertEquals(true, $group->getSettings()?->getAutomaticMoveUp());
        $this->assertEquals(false, $group->getSettings()?->getIsPublic());
        $this->assertEquals([], $group->getSettings()?->getGroupMeeting());
        $this->assertEquals(false, $group->getSettings()?->getQrCodeCheckin());
        $this->assertEquals([], $group->getSettings()?->getNewMember());

        // GroupRoles
        $groupRole = $group->getRoles()[0];
        $this->assertEquals("21", $groupRole->getId());
        $this->assertEquals("21", $groupRole->getGroupTypeId());
        $this->assertEquals("Admin", $groupRole->getName());
        $this->assertEquals("Adm", $groupRole->getShorty());
        $this->assertEquals("name", $groupRole->getSortKey());
        $this->assertEquals(true, $groupRole->getToDelete());
        $this->assertEquals(false, $groupRole->getHasRequested());
        $this->assertEquals(false, $groupRole->getIsLeader());
        $this->assertEquals(false, $groupRole->getIsDefault());
        $this->assertEquals(false, $groupRole->getIsHidden());
        $this->assertEquals(false, $groupRole->getGrowPathId());
        $this->assertEquals(false, $groupRole->getGroupTypeRoleId());
        $this->assertEquals(false, $groupRole->getForceTwoFactorAuth());
        $this->assertEquals(true, $groupRole->getIsActive());
        $this->assertEquals(true, $groupRole->getCanReadChat());
        $this->assertEquals(true, $groupRole->getCanWriteChat());

        // GroupMembers
        $groupMember = $group->requestMembers()?->get()[0];

        $this->assertEquals(12, $groupMember?->getPersonId());
        $this->assertEquals(16, $groupMember?->getGroupTypeRoleId());
        $this->assertEquals("active", $groupMember?->getGroupMemberStatus());
        $this->assertEquals("2023-05-04", $groupMember?->getMemberStartDate());
        $this->assertEquals("2023-06-01", $groupMember?->getMemberEndDate());
        $this->assertEquals("2023-05-04 00:00:00", $groupMember?->getMemberStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("2023-06-01 00:00:00", $groupMember?->getMemberEndDateAsDateTime()?->format("Y-m-d H:i:s"));

        $this->assertEquals(null, $groupMember?->getFollowUpStep());
        $this->assertEquals(null, $groupMember?->getFollowUpDiffDays());
        $this->assertEquals(null, $groupMember?->getFollowUpUnsuccessfulBackGroupId());

        $this->assertEquals(null, $groupMember?->getComment());
        $this->assertEquals(null, $groupMember?->getWaitinglistPosition());
        $this->assertEquals([], $groupMember?->getFields());
        $this->assertEquals([], $groupMember?->getPersonFields());

        $personGroupMember = $groupMember?->getPerson();
        $personGroupMember = $groupMember?->requestPerson();

        // Retrieve Group-Tags
        $tags = $group->requestTags()?->get();

        $tag = end($tags);
        $this->assertEquals("Leader", $tag->getName());
        $this->assertEquals(8, $tag->getId());

        /**
         * Upadate Group-Image: See FileAPI
         */
        $files = $group->requestGroupImage()?->get() ?? [];
        $groupImage = end($files);
        $this->assertEquals("image-1.png", $groupImage->getName());

        //$group->requestGroupImage()?->upload("new-group-image.png");
    }
}
