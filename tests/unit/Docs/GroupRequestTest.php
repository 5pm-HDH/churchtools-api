<?php

namespace Tests\Unit\Docs;

use CTApi\Requests\GroupRequest;
use CTApi\Requests\PersonRequest;
use Tests\Unit\TestCaseDocExampleCode;
use Tests\Unit\TestCaseHttpMocked;

class GroupRequestTest extends TestCaseHttpMocked
{

    function testDocExample()
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
        $this->assertEquals(null, $group->getInformation());
        $this->assertEquals([], $group->getFollowUp());
        $this->assertEquals("Admin", $group->getRoles()[0]->getName());

        // GroupHierarchie
        $childGroups = $group->requestGroupChildren()?->get();
        $parentGroups = $group->requestGroupParents()?->get();

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

        $this->assertEquals("21", $groupMember?->getId());
        $this->assertEquals(null, $groupMember?->getPersonId());
        $this->assertEquals(null, $groupMember?->getGroupTypeRoleId());
        $this->assertEquals(null, $groupMember?->getMemberStartDate());
        $this->assertEquals(null, $groupMember?->getComment());
        $this->assertEquals(null, $groupMember?->getMemberEndDate());
        $this->assertEquals(null, $groupMember?->getWaitinglistPosition());
        $this->assertEquals([], $groupMember?->getFields());

        $personGroupMember = $groupMember?->getPerson();
        $personGroupMember = $groupMember?->requestPerson();

        /**
         * Upadate Group-Image: See FileAPI
         */
        $files = $group->requestGroupImage()?->get();
        $groupImage = end($files);
        $this->assertEquals("image-1.png", $groupImage->getName());

        //$group->requestGroupImage()?->upload("new-group-image.png");
    }
}