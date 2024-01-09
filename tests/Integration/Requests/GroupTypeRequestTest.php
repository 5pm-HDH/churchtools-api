<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Groups\Group\GroupTypeRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class GroupTypeRequestTest extends TestCaseAuthenticated
{
    private int $groupTypeId1;
    private int $groupTypeId2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->groupTypeId1 = IntegrationTestData::getResultAsInt("group_types", "any_group_type_1.id");
        $this->groupTypeId2 = IntegrationTestData::getResultAsInt("group_types", "any_group_type_2.id");
    }

    public function testGetAll()
    {
        $groupTypes = GroupTypeRequest::all();

        $groupType1 = null;
        $groupType2 = null;
        foreach ($groupTypes as $groupType) {
            if ($groupType->getIdAsInteger() === $this->groupTypeId1) {
                $groupType1 = $groupType;
            }
            if ($groupType->getIdAsInteger() === $this->groupTypeId2) {
                $groupType2 = $groupType;
            }
        }
        $this->assertNotNull($groupType1);
        $this->assertNotNull($groupType2);

        $this->assertEqualsTestData("group_types", "any_group_type_1.name", $groupType1->getName());
        $this->assertEqualsTestData("group_types", "any_group_type_1.namePlural", $groupType1->getNamePlural());
        $this->assertEqualsTestData("group_types", "any_group_type_1.permissionDepth", $groupType1->getPermissionDepth());
        $this->assertEqualsTestData("group_types", "any_group_type_1.shorty", $groupType1->getShorty());

        $this->assertEqualsTestData("group_types", "any_group_type_2.name", $groupType2->getName());
        $this->assertEqualsTestData("group_types", "any_group_type_2.namePlural", $groupType2->getNamePlural());
        $this->assertEqualsTestData("group_types", "any_group_type_2.permissionDepth", $groupType2->getPermissionDepth());
        $this->assertEqualsTestData("group_types", "any_group_type_2.shorty", $groupType2->getShorty());
    }

    public function testFind()
    {
        $groupType1 = GroupTypeRequest::find($this->groupTypeId1);
        $this->assertEqualsTestData("group_types", "any_group_type_1.name", $groupType1->getName());
        $this->assertEqualsTestData("group_types", "any_group_type_1.namePlural", $groupType1->getNamePlural());
        $this->assertEqualsTestData("group_types", "any_group_type_1.permissionDepth", $groupType1->getPermissionDepth());
        $this->assertEqualsTestData("group_types", "any_group_type_1.shorty", $groupType1->getShorty());
    }

    public function testFindOrFail()
    {
        $groupType1 = GroupTypeRequest::findOrFail($this->groupTypeId1);
        $this->assertEqualsTestData("group_types", "any_group_type_1.name", $groupType1->getName());
        $this->assertEqualsTestData("group_types", "any_group_type_1.namePlural", $groupType1->getNamePlural());
        $this->assertEqualsTestData("group_types", "any_group_type_1.permissionDepth", $groupType1->getPermissionDepth());
        $this->assertEqualsTestData("group_types", "any_group_type_1.shorty", $groupType1->getShorty());
    }


    public function testFindOrFail_Failing()
    {
        $this->expectException(CTRequestException::class);
        $groupType1 = GroupTypeRequest::findOrFail(999999);
    }

    public function testGetOrderBy()
    {
        $orderedById = GroupTypeRequest::orderBy("id")->get();

        $indexGroupType1 = null;
        $indexGroupType2 = null;

        $index = 0;
        foreach ($orderedById as $groupType) {
            if ($groupType->getIdAsInteger() === $this->groupTypeId1) {
                $indexGroupType1 = $index;
            }
            if ($groupType->getIdAsInteger() === $this->groupTypeId2) {
                $indexGroupType2 = $index;
            }
            $index++;
        }

        $this->assertNotNull($indexGroupType1);
        $this->assertNotNull($indexGroupType2);

        $this->assertTrue($indexGroupType1 < $indexGroupType2);
    }

    public function testGetOrderBy_DESC()
    {
        $orderedById = GroupTypeRequest::orderBy("id", false)->get();

        $indexGroupType1 = null;
        $indexGroupType2 = null;

        $index = 0;
        foreach ($orderedById as $groupType) {
            if ($groupType->getIdAsInteger() === $this->groupTypeId1) {
                $indexGroupType1 = $index;
            }
            if ($groupType->getIdAsInteger() === $this->groupTypeId2) {
                $indexGroupType2 = $index;
            }
            $index++;
        }

        $this->assertNotNull($indexGroupType1);
        $this->assertNotNull($indexGroupType2);

        $this->assertTrue($indexGroupType1 > $indexGroupType2);
    }

    public function testGetOrderBy_Name()
    {
        $orderedByName = GroupTypeRequest::orderBy("name")->get();

        $indexGroupType1 = null;
        $indexGroupType2 = null;

        $index = 0;
        foreach ($orderedByName as $groupType) {
            if ($groupType->getIdAsInteger() === $this->groupTypeId1) {
                $indexGroupType1 = $index;
            }
            if ($groupType->getIdAsInteger() === $this->groupTypeId2) {
                $indexGroupType2 = $index;
            }
            $index++;
        }

        $this->assertNotNull($indexGroupType1);
        $this->assertNotNull($indexGroupType2);

        $this->assertTrue($indexGroupType1 > $indexGroupType2);
    }
}
