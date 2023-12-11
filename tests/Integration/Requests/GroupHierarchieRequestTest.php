<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Models\Common\Auth\AuthRequest;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;


class GroupHierarchieRequestTest extends TestCaseAuthenticated
{

    private $groupId = "";
    private $groupName = "";
    private $groupParentId = ""; /** @phpstan-ignore-line */
    private $groupParentName = ""; /** @phpstan-ignore-line */
    private $groupChildId = ""; /** @phpstan-ignore-line */
    private $groupChildName = ""; /** @phpstan-ignore-line */

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
        $this->markTestSkipped("ChurchTools API Endpoint is broken. Fix in issue: https://github.com/5pm-HDH/churchtools-api/issues/183");
        $group = GroupRequest::findOrFail($this->groupId); /** @phpstan-ignore-line */

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
        $this->markTestSkipped("ChurchTools API Endpoint is broken. Fix in issue: https://github.com/5pm-HDH/churchtools-api/issues/183");
        $group = GroupRequest::findOrFail($this->groupId); /** @phpstan-ignore-line */

        CTLog::enableConsoleLog();
        CTConfig::enableDebugging();
        CTLog::enableHttpLog();
        echo "\n". AuthRequest::retrieveApiToken(12) . "\n";

        $children = $group->requestGroupChildren()?->get();
        $this->assertNotNull($children);

        print_r($children);

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