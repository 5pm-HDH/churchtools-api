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
echo ($group->getId());
// OUTPUT: 21
echo ($group->getGuid());
// OUTPUT: g21
echo ($group->getName());
// OUTPUT: Sermon Group
echo ($group->getSecurityLevelForGroup());
// OUTPUT: High
echo ($group->getPermissions());
// OUTPUT: []
echo ($group->getInformation());
// OUTPUT: []
echo ($group->getFollowUp());
// OUTPUT: []
echo ($group->getRoles());
// OUTPUT: [{}]

echo ("GroupHierarchie\n");
// OUTPUT: GroupHierarchie

$childGroups = $group->requestGroupChildren()?->get();
$parentGroups = $group->requestGroupParents()?->get();

echo ("GroupSettings\n");
// OUTPUT: GroupSettings

echo ($group->getSettings()?->getIsHidden());
// OUTPUT: 
echo ($group->getSettings()?->getIsOpenForMembers());
// OUTPUT: 
echo ($group->getSettings()?->getAllowSpouseRegistration());
// OUTPUT: 
echo ($group->getSettings()?->getAllowChildRegistration());
// OUTPUT: 
echo ($group->getSettings()?->getAllowSameEmailRegistration());
// OUTPUT: 
echo ($group->getSettings()?->getAutoAccept());
// OUTPUT: 
echo ($group->getSettings()?->getAllowWaitinglist());
// OUTPUT: 
echo ($group->getSettings()?->getWaitinglistMaxPersons());
// OUTPUT: 
echo ($group->getSettings()?->getAutomaticMoveUp());
// OUTPUT: 
echo ($group->getSettings()?->getIsPublic());
// OUTPUT: 
echo ($group->getSettings()?->getGroupMeeting());
// OUTPUT: 
echo ($group->getSettings()?->getQrCodeCheckin());
// OUTPUT: 
echo ($group->getSettings()?->getNewMember());
// OUTPUT: 

echo ("GroupRoles\n");
// OUTPUT: GroupRoles

$groupRole = $group->getRoles()[0];
echo ($groupRole->getId());
// OUTPUT: 21
echo ($groupRole->getGroupTypeId());
// OUTPUT: 21
echo ($groupRole->getName());
// OUTPUT: Admin
echo ($groupRole->getShorty());
// OUTPUT: Adm
echo ($groupRole->getSortKey());
// OUTPUT: name
echo ($groupRole->getToDelete());
// OUTPUT: 
echo ($groupRole->getHasRequested());
// OUTPUT: 
echo ($groupRole->getIsLeader());
// OUTPUT: 
echo ($groupRole->getIsDefault());
// OUTPUT: 
echo ($groupRole->getIsHidden());
// OUTPUT: 
echo ($groupRole->getGrowPathId());
// OUTPUT: 
echo ($groupRole->getGroupTypeRoleId());
// OUTPUT: 
echo ($groupRole->getForceTwoFactorAuth());
// OUTPUT: 
echo ($groupRole->getIsActive());
// OUTPUT: 
echo ($groupRole->getCanReadChat());
// OUTPUT: 
echo ($groupRole->getCanWriteChat());
// OUTPUT: 

echo ("GroupMembers");
// OUTPUT: GroupMembers
$groupMember = $group->requestMembers()->get()[0];

echo ($groupMember->getId());
// OUTPUT: 21
echo ($groupMember->getPersonId());
// OUTPUT: 
echo ($groupMember->getGroupTypeRoleId());
// OUTPUT: 
echo ($groupMember->getMemberStartDate());
// OUTPUT: 
echo ($groupMember->getComment());
// OUTPUT: 
echo ($groupMember->getMemberEndDate());
// OUTPUT: 
echo ($groupMember->getWaitinglistPosition());
// OUTPUT: 
echo ($groupMember->getFields());
// OUTPUT: []

$personGroupMember = $groupMember->getPerson();
$personGroupMember = $groupMember->requestPerson();

```