# GroupAPI

Group-Request & Group-Data:

```
        /**
         * Group-Request
         */

        // Retrieve all groups
        $allGroups = GroupRequest::all();
        $allGroups = GroupRequest::orderBy('name')->get();

        $myGroups = PersonRequest::whoami()?->requestGroups();

        // Get specific Group
        $group = GroupRequest::find(21);     // returns "null" if id is invalid
        $group = GroupRequest::findOrFail(21); // throws exception if id is invalid


        /**
         * Group-Data
         */
        var_dump( $group->getId());
        // Output: 21

        var_dump( $group->getGuid());
        // Output: "g21"

        var_dump( $group->getName());
        // Output: "Sermon Group"

        var_dump( $group->getSecurityLevelForGroup());
        // Output: "High"

        var_dump( $group->getPermissions());
        // Output: []

        var_dump( $group->getInformation());
        // Output: null

        var_dump( $group->getFollowUp());
        // Output: []

        var_dump( $group->getRoles()[0]->getName());
        // Output: "Admin"


        // GroupHierarchie
        $childGroups = $group->requestGroupChildren()?->get();
        $parentGroups = $group->requestGroupParents()?->get();

        // GroupSettings;
        var_dump( $group->getSettings()?->getIsHidden());
        // Output: false

        var_dump( $group->getSettings()?->getIsOpenForMembers());
        // Output: true

        var_dump( $group->getSettings()?->getAllowSpouseRegistration());
        // Output: true

        var_dump( $group->getSettings()?->getAllowChildRegistration());
        // Output: true

        var_dump( $group->getSettings()?->getAllowSameEmailRegistration());
        // Output: true

        var_dump( $group->getSettings()?->getAutoAccept());
        // Output: true

        var_dump( $group->getSettings()?->getAllowWaitinglist());
        // Output: true

        var_dump( $group->getSettings()?->getWaitinglistMaxPersons());
        // Output: 21

        var_dump( $group->getSettings()?->getAutomaticMoveUp());
        // Output: true

        var_dump( $group->getSettings()?->getIsPublic());
        // Output: false

        var_dump( $group->getSettings()?->getGroupMeeting());
        // Output: []

        var_dump( $group->getSettings()?->getQrCodeCheckin());
        // Output: false

        var_dump( $group->getSettings()?->getNewMember());
        // Output: []


        // GroupRoles
        $groupRole = $group->getRoles()[0];
        var_dump( $groupRole->getId());
        // Output: "21"

        var_dump( $groupRole->getGroupTypeId());
        // Output: "21"

        var_dump( $groupRole->getName());
        // Output: "Admin"

        var_dump( $groupRole->getShorty());
        // Output: "Adm"

        var_dump( $groupRole->getSortKey());
        // Output: "name"

        var_dump( $groupRole->getToDelete());
        // Output: true

        var_dump( $groupRole->getHasRequested());
        // Output: false

        var_dump( $groupRole->getIsLeader());
        // Output: false

        var_dump( $groupRole->getIsDefault());
        // Output: false

        var_dump( $groupRole->getIsHidden());
        // Output: false

        var_dump( $groupRole->getGrowPathId());
        // Output: false

        var_dump( $groupRole->getGroupTypeRoleId());
        // Output: false

        var_dump( $groupRole->getForceTwoFactorAuth());
        // Output: false

        var_dump( $groupRole->getIsActive());
        // Output: true

        var_dump( $groupRole->getCanReadChat());
        // Output: true

        var_dump( $groupRole->getCanWriteChat());
        // Output: true


        // GroupMembers
        $groupMember = $group->requestMembers()->get()[0];

        var_dump( $groupMember->getId());
        // Output: "21"

        var_dump( $groupMember->getPersonId());
        // Output: null

        var_dump( $groupMember->getGroupTypeRoleId());
        // Output: null

        var_dump( $groupMember->getMemberStartDate());
        // Output: null

        var_dump( $groupMember->getComment());
        // Output: null

        var_dump( $groupMember->getMemberEndDate());
        // Output: null

        var_dump( $groupMember->getWaitinglistPosition());
        // Output: null

        var_dump( $groupMember->getFields());
        // Output: []


        $personGroupMember = $groupMember->getPerson();
        $personGroupMember = $groupMember->requestPerson();

```