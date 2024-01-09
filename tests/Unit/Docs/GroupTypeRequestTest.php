<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Groups\Group\GroupType;
use CTApi\Models\Groups\Group\GroupTypeRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class GroupTypeRequestTest extends TestCaseHttpMocked
{
    public function testGetAll()
    {
        $groupTypes = GroupTypeRequest::all();

        $groupTypeNames = array_map(function (GroupType $groupType) {
            return $groupType->getName();
        }, $groupTypes);

        $groupTypeNameList = implode("/", $groupTypeNames);
        $this->assertEquals("Dienst/Kleingruppe/Maßnahme/Merkmal", $groupTypeNameList);
    }

    public function testFind()
    {
        $groupType = GroupTypeRequest::find(2);

        $this->assertEquals("Dienst", $groupType?->getName());
        $this->assertEquals("Dienst", $groupType?->getNameTranslated());
        $this->assertEquals("Dienste", $groupType?->getNamePlural());
        $this->assertEquals("Dienste", $groupType?->getNamePluralTranslated());
        $this->assertEquals("DT", $groupType?->getShorty());
        $this->assertEquals("", $groupType?->getDescription());
        $this->assertEquals(false, $groupType?->getIsLeaderNecessary());
        $this->assertEquals(false, $groupType?->getAvailableForNewPerson());
        $this->assertEquals(1, $groupType?->getPermissionDepth());
        $this->assertEquals(0, $groupType?->getSortKey());
    }

}
