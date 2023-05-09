<?php


namespace Tests\Integration\Requests;


use CTApi\Requests\GroupRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class GroupHierarchieRequestTest extends TestCaseAuthenticated
{

    private $groupId = "";
    private $groupName = "";
    private $groupParentId = "";
    private $groupParentName = "";
    private $groupChildId = "";
    private $groupChildName = "";

    protected function setUp(): void
    {
        $this->groupId = IntegrationTestData::getFilter("get_group_hierarchie", "group_id");

        $this->groupName = IntegrationTestData::getResult("get_group_hierarchie", "group_name");
        $this->groupParentId = IntegrationTestData::getResult("get_group_hierarchie", "parent_group_id");
        $this->groupParentName = IntegrationTestData::getResult("get_group_hierarchie", "parent_group_name");
        $this->groupChildId = IntegrationTestData::getResult("get_group_hierarchie", "child_group_id");
        $this->groupChildName = IntegrationTestData::getResult("get_group_hierarchie", "child_group_name");

    }

    public function testRequestGroup()
    {
        $group = GroupRequest::findOrFail($this->groupId);
        $this->assertEquals($this->groupName, $group->getName());
    }

    public function testRequestGroupParents()
    {
        $group = GroupRequest::findOrFail($this->groupId);

        $parents = $group->requestGroupParents()?->get();
        $this->assertNotNull($parents);

        $foundParent = null;
        foreach ($parents as $parent) {
            if ($parent->getId() == $this->groupParentId) {
                $foundParent = $parent;
            }
        }

        $this->assertNotNull($foundParent);
        $this->assertEquals($this->groupParentName, $foundParent->getName());
    }

    public function testRequestGroupChildren()
    {
        $group = GroupRequest::findOrFail($this->groupId);

        $children = $group->requestGroupChildren()?->get();
        $this->assertNotNull($children);

        $foundChild = null;
        foreach ($children as $child) {
            if ($child->getId() == $this->groupChildId) {
                $foundChild = $child;
            }
        }

        $this->assertNotNull($foundChild);
        $this->assertEquals($this->groupChildName, $foundChild->getName());
    }

}