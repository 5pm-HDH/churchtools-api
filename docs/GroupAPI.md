# GroupAPI

```php
use CTApi\Requests\GroupRequest;use CTApi\Requests\PersonRequest;

/**
 * Group-Request
 */
 
// Retrieve all groups
$allGroups = GroupRequest::all();
$allGroups = GroupRequest::orderBy('name')->get();

$myGroups = PersonRequest::whoami()?->requestGroups();

// Get specific Group
$group = GroupRequest::find(21);     // returns "null" if id is invalid
$group = GroupRequest::findOrFail(22); // throws exception if id is invalid


/**
 * Group-Data
 */
echo "-".$group->getId();
echo "-".$group->getGuid();
echo "-".$group->getName();
print_r($group->getSecurityLevelForGroup());
print_r($group->getPermissions());
print_r($group->getInformation());
print_r($group->getFollowUp());
print_r($group->getRoles());

echo "GroupSettings\n";
echo "-".$group->getSettings()?->getIsHidden();
echo "-".$group->getSettings()?->getIsOpenForMembers();
echo "-".$group->getSettings()?->getAllowSpouseRegistration();
echo "-".$group->getSettings()?->getAllowChildRegistration();
echo "-".$group->getSettings()?->getAllowSameEmailRegistration();
echo "-".$group->getSettings()?->getAutoAccept();
echo "-".$group->getSettings()?->getAllowWaitinglist();
echo "-".$group->getSettings()?->getWaitinglistMaxPersons();
echo "-".$group->getSettings()?->getAutomaticMoveUp();
echo "-".$group->getSettings()?->getIsPublic();
print_r($group->getSettings()?->getGroupMeeting());
echo "-".$group->getSettings()?->getQrCodeCheckin();
print_r($group->getSettings()?->getNewMember());

echo "GroupRoles\n";
$groupRole = $group->getRoles()[0];
echo "-".$groupRole->getId();
echo "-".$groupRole->getGroupTypeId();
echo "-".$groupRole->getName();
echo "-".$groupRole->getShorty();
echo "-".$groupRole->getShortKey();
echo "-".$groupRole->getToDelete();
echo "-".$groupRole->getHasRequested();
echo "-".$groupRole->getIsLeader();
echo "-".$groupRole->getIsDefault();
echo "-".$groupRole->getIsHidden();
echo "-".$groupRole->getGrowPathId();
echo "-".$groupRole->getGroupTypeRoleId();
echo "-".$groupRole->getForceTwoFactorAuth();
echo "-".$groupRole->getIsActive();
echo "-".$groupRole->getCanReadChat();
echo "-".$groupRole->getCanWriteChat();

echo "GroupMembers";
$groupMember = $group->requestMembers()[0];

echo "-".$groupMember->getId();
echo "-".$groupMember->getPersonId();
echo "-".$groupMember->getGroupTypeRoleId();
echo "-".$groupMember->getMemberStartDate();
echo "-".$groupMember->getComment();
echo "-".$groupMember->getMemberEndDate();
echo "-".$groupMember->getWaitinglistPosition();
print_r($groupMember->getFields());

$personGroupMember = $groupMember->getPerson();
$personGroupMember = $groupMember->requestPerson();

```