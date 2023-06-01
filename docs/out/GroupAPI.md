# GroupAPI

## Group-Request & Group-Data:

```php
        use CTApi\Requests\GroupRequest;
        use CTApi\Requests\PersonRequest;

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
        $groupMember = $group->requestMembers()?->get()[0];

        var_dump( $groupMember?->getId());
        // Output: "21"

        var_dump( $groupMember?->getPersonId());
        // Output: null

        var_dump( $groupMember?->getGroupTypeRoleId());
        // Output: null

        var_dump( $groupMember?->getMemberStartDate());
        // Output: null

        var_dump( $groupMember?->getComment());
        // Output: null

        var_dump( $groupMember?->getMemberEndDate());
        // Output: null

        var_dump( $groupMember?->getWaitinglistPosition());
        // Output: null

        var_dump( $groupMember?->getFields());
        // Output: []


        $personGroupMember = $groupMember?->getPerson();
        $personGroupMember = $groupMember?->requestPerson();

        /**
         * Upadate Group-Image: See FileAPI
         */
        $files = $group->requestGroupImage()?->get() ?? [];
        $groupImage = end($files);
        var_dump( $groupImage->getName());
        // Output: "image-1.png"


        //$group->requestGroupImage()?->upload("new-group-image.png");

```

## Add, remove and update group-members:

```php
        use CTApi\Requests\GroupMemberRequest;

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

```

## Group-Meetings

```php
        use CTApi\CTConfig;
        use CTApi\Models\Group;
        use CTApi\Requests\GroupMeetingRequest;
        use CTApi\Requests\GroupRequest;

        $meetings = $this->group->requestGroupMeetings()
            ?->where("start_date", "2022-11-01")
            ->where("end_date", "2022-11-15")
            ->get();

        $meeting = $meetings[0];

        var_dump( $meeting->getId());
        // Output: 2652

        var_dump( $meeting->getGroupId());
        // Output: 21

        var_dump( $meeting->getDateFrom());
        // Output: "2022-11-09T18:30:00Z"

        var_dump( $meeting->getDateTo());
        // Output: "2022-11-09T18:30:00Z"

        var_dump( $meeting->getIsCompleted());
        // Output: true

        var_dump( $meeting->getIsCanceled());
        // Output: false

        var_dump( $meeting->getHasEditingStarted());
        // Output: true

        var_dump( $meeting->getNumGuests());
        // Output: 5

        var_dump( $meeting->getComment());
        // Output: "Hello World"


        var_dump( $meeting?->getStatistics()->getPresent());
        // Output: 2

        var_dump( $meeting?->getStatistics()->getAbsent());
        // Output: 1

        var_dump( $meeting?->getStatistics()->getUnsure());
        // Output: 0


```

```php
        use CTApi\CTConfig;
        use CTApi\Models\Group;
        use CTApi\Requests\GroupMeetingRequest;
        use CTApi\Requests\GroupRequest;

        $meetings = GroupMeetingRequest::forGroup(21)->get();
        $meeting = $meetings[0];

        $meetingMembers = $meeting->requestMembers()->get();
        $meetingMember = $meetingMembers[0];

        var_dump( $meetingMember->getIsCheckedIn());
        // Output: true

        var_dump( $meetingMember->getStatus());
        // Output: "present"


        $groupMember = $meetingMember->getMember();
        // see GroupMember-Model

```

## GroupMemberFields

```php
        use Requests\GroupMemberFieldsRequest;

        $fields = GroupMemberFieldsRequest::forGroup(9)->get();

        /**
         * Array of GroupMemberFieldContainer. A GroupMemberFieldContainer can contain in either contain a Person-Field or a GroupMember-Field in its field-property (type: null|GroupMemberField|DBFieldContainer).
         */
        $personField = $fields[0];
        $memberField = $fields[1];
        // $thirdField = $fields[3];
        // ... = $fields[...];

        /**
         * Person Field (DB-Field)
         */
        // type can be "person" (Person-Fields) or "group" (Group-Member-Fields)
        var_dump( $personField->getType());
        // Output: "person"


        // GroupMemberFieldContainer->getField() can contain DBField or GroupMemberField.
        $dbField = $personField->getDBFieldIfExists();
        $unknownField = $personField->getGroupMemberFieldIfExists();
        var_dump( $unknownField);
        // Output: null


        var_dump( $dbField->getId());
        // Output: "54"

        var_dump( $dbField->getIdAsInteger());
        // Output: 54


        var_dump( $dbField->getName());
        // Output: "nickname"

        var_dump( $dbField->getNameTranslated());
        // Output: "Spitzname"

        var_dump( $dbField->getColumn());
        // Output: "spitzname"


        var_dump( $dbField->getFieldCategory()?->getInternCode());
        // Output: "f_address"

        var_dump( $dbField->getFieldType()?->getInternCode());
        // Output: "text"

        var_dump( $dbField->getFieldType()?->getId());
        // Output: 1


        var_dump( $dbField->getLineEnding());
        // Output: "(%) "

        var_dump( $dbField->getSecurityLevel());
        // Output: 1

        var_dump( $dbField->getLength());
        // Output: 30

        var_dump( $dbField->getSortKey());
        // Output: 3


        var_dump( $dbField->getIsActive());
        // Output: true

        var_dump( $dbField->getIsNewPersonField());
        // Output: false

        var_dump( $dbField->getDeleteOnArchive());
        // Output: false

        var_dump( $dbField->getNullable());
        // Output: false

        var_dump( $dbField->getHideInFrontend());
        // Output: false

        var_dump( $dbField->getIsBasicInfo());
        // Output: false


        var_dump( $dbField->getOptions());
        // Output: []


        /**
         * GroupMemberField
         */

        var_dump( $memberField->getType());
        // Output: "group"


        $vocalRangeField = $memberField->getGroupMemberFieldIfExists();

        var_dump( $vocalRangeField->getFieldName());
        // Output: "vocal range"

        var_dump( $vocalRangeField->getNote());
        // Output: "vocal range of person from key to key"

        var_dump( $vocalRangeField->getSortKey());
        // Output: 1

        var_dump( $vocalRangeField->getFieldTypeId());
        // Output: 1

        var_dump( $vocalRangeField->getFieldTypeCode());
        // Output: "text"

        var_dump( $vocalRangeField->getSecurityLevel());
        // Output: 1

        var_dump( $vocalRangeField->getDefaultValue());
        // Output: null

        var_dump( $vocalRangeField->getOptions());
        // Output: []


```