<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTLog;
use CTApi\Models\Groups\Group\GroupType;
use CTApi\Models\Groups\GroupTypeRole\GroupTypeRole;
use CTApi\Models\Groups\GroupTypeRole\GroupTypeRoleRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class GroupTypeRoleRequestTest extends TestCaseAuthenticated
{
    private int $id;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = IntegrationTestData::getResultAsInt("group_type_roles", "any_group_type_role.id");
    }

    public function testGetAll()
    {
        CTLog::enableHttpLog();
        $groupTypeRoles = GroupTypeRoleRequest::all();

        $foundGroupTypeRole = null;
        foreach ($groupTypeRoles as $groupTypeRole) {
            if ($groupTypeRole->getIdAsInteger() === $this->id) {
                $foundGroupTypeRole = $groupTypeRole;
            }
        }

        $this->assertNotNull($foundGroupTypeRole);
        $this->assertGroupTypeRole($foundGroupTypeRole);
    }

    public function testGetGroupTypeRole()
    {
        $groupTypeRole = GroupTypeRoleRequest::findOrFail($this->id);
        $this->assertGroupTypeRole($groupTypeRole);

        $groupType = $groupTypeRole->requestGroupType();
        $this->assertGroupType($groupType);
    }

    private function assertGroupTypeRole(GroupTypeRole $groupTypeRole): void
    {
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.id", $groupTypeRole->getGroupTypeId());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.name", $groupTypeRole->getName());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.shorty", $groupTypeRole->getShorty());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.type", $groupTypeRole->getType());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.isDefault", $groupTypeRole->getIsDefault());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.isHidden", $groupTypeRole->getIsHidden());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.isLeader", $groupTypeRole->getIsLeader());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.sortKey", $groupTypeRole->getSortKey());
    }

    private function assertGroupType(GroupType $groupType): void
    {
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.id", $groupType->getId());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.availableForNewPerson", $groupType->getAvailableForNewPerson());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.isLeaderNecessary", $groupType->getIsLeaderNecessary());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.name", $groupType->getName());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.permissionDepth", $groupType->getPermissionDepth());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.shorty", $groupType->getShorty());
        $this->assertEqualsTestData("group_type_roles", "any_group_type_role.groupType.sortKey", $groupType->getSortKey());
    }
}
