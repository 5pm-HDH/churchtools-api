# GroupAPI

Group-Request & Group-Data:

```php
use CTApi\Requests\GroupRequest;
use CTApi\Requests\PersonRequest;

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
dd($group->getId());
dd($group->getGuid());
dd($group->getName());
dd($group->getSecurityLevelForGroup());
dd($group->getPermissions());
dd($group->getInformation());
dd($group->getFollowUp());
dd($group->getRoles());

dd("GroupSettings\n");
dd($group->getSettings()?->getIsHidden());
dd($group->getSettings()?->getIsOpenForMembers());
dd($group->getSettings()?->getAllowSpouseRegistration());
dd($group->getSettings()?->getAllowChildRegistration());
dd($group->getSettings()?->getAllowSameEmailRegistration());
dd($group->getSettings()?->getAutoAccept());
dd($group->getSettings()?->getAllowWaitinglist());
dd($group->getSettings()?->getWaitinglistMaxPersons());
dd($group->getSettings()?->getAutomaticMoveUp());
dd($group->getSettings()?->getIsPublic());
dd($group->getSettings()?->getGroupMeeting());
dd($group->getSettings()?->getQrCodeCheckin());
dd($group->getSettings()?->getNewMember());

dd("GroupRoles\n");
$groupRole = $group->getRoles()[0];
dd($groupRole->getId());
dd($groupRole->getGroupTypeId());
dd($groupRole->getName());
dd($groupRole->getShorty());
dd($groupRole->getSortKey());
dd($groupRole->getToDelete());
dd($groupRole->getHasRequested());
dd($groupRole->getIsLeader());
dd($groupRole->getIsDefault());
dd($groupRole->getIsHidden());
dd($groupRole->getGrowPathId());
dd($groupRole->getGroupTypeRoleId());
dd($groupRole->getForceTwoFactorAuth());
dd($groupRole->getIsActive());
dd($groupRole->getCanReadChat());
dd($groupRole->getCanWriteChat());

dd("GroupMembers");
$groupMember = $group->requestMembers()->get()[0];

dd($groupMember->getId());
dd($groupMember->getPersonId());
dd($groupMember->getGroupTypeRoleId());
dd($groupMember->getMemberStartDate());
dd($groupMember->getComment());
dd($groupMember->getMemberEndDate());
dd($groupMember->getWaitinglistPosition());
dd($groupMember->getFields());

$personGroupMember = $groupMember->getPerson();
$personGroupMember = $groupMember->requestPerson();
```