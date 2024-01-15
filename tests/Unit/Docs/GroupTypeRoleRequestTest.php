<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Groups\GroupTypeRole\GroupTypeRoleRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class GroupTypeRoleRequestTest extends TestCaseHttpMocked
{
    public function testGetGroupTypeRoleRequest()
    {
        $roles = GroupTypeRoleRequest::all();
        $role = $roles[0];

        $this->assertEquals(15, $role->getId());
        $this->assertEquals(2, $role->getGroupTypeId());
        $groupType = $role->requestGroupType();
        $this->assertEquals(null, $role->getGrowPathId());
        $this->assertEquals("Mitarbeiter", $role->getName());
        $this->assertEquals("MA", $role->getShorty());
        $this->assertEquals("participant", $role->getType());
        $this->assertEquals(true, $role->getIsDefault());
        $this->assertEquals(false, $role->getIsHidden());
        $this->assertEquals(false, $role->getIsLeader());
        $this->assertEquals(0, $role->getSortKey());
    }

}
