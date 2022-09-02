<?php


namespace Tests\Integration\Requests;


use CTApi\Requests\PermissionRequest;
use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class PermissionRequestTest extends TestCaseAuthenticated
{
    // Test Permission Group
    private $groupId = "";
    private $groupAddPersion = null;

    // Test Permission Person
    private $personInvitePerson = null;

    // Test Global Permission
    private $churchCore_AdministerSettings = null;
    private $churchDb_ViewBirthdaylist = null;
    private $churchCal_AssistanceMode = null;
    private $churchResource_CreateVirtualBookings = null;
    private $churchService_ViewHistory = null;
    private $churchWiki_EditMasterdata = null;
    private $churchCheckin_CreatePerson = null;

    protected function setUp(): void
    {
        if (!TestData::getValue("GROUP_HIERARCHIE_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->groupId = TestData::getValue("PERMISSION_GROUP_ID");
            $this->groupAddPersion = TestData::getValue("PERMISSION_GROUP_ADD_PERSON");

            $this->personInvitePerson = TestData::getValueAsBool("PERMISSION_PERSON_INVITE_PERSON");

            $this->churchCore_AdministerSettings = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_CORE_ADMINISTER_SETTINGS");
            $this->churchDb_ViewBirthdaylist = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_DB_VIEW_BIRTHDAYLIST");
            $this->churchCal_AssistanceMode = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_CAL_ASSISTANCE_MODE");
            $this->churchResource_CreateVirtualBookings = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_RESOURCE_CREATE_VIRTUAL_BOOKINGS");
            $this->churchService_ViewHistory = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_SERVICE_VIEW_HISTORY");
            $this->churchWiki_EditMasterdata = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_WIKI_EDIT_MASTERDATA");
            $this->churchCheckin_CreatePerson = TestData::getValueAsBool("PERMISSION_GLOBAL_CHURCH_CHECKIN_CREATE_PERSON");
        }
    }

    public function testGroupPermission()
    {
        $internalGroupPermission = PermissionRequest::forGroup((int)$this->groupId)->get();
        $this->assertNotNull($internalGroupPermission->getAddPerson());
        $this->assertEquals($this->groupAddPersion, $internalGroupPermission->getAddPerson());
    }

    public function testPersonPermission()
    {
        $myself = PersonRequest::whoami();
        $internalPersonPermission = PermissionRequest::forPerson((int)$myself->getId())->get();
        $this->assertNotNull($internalPersonPermission->getInvitePerson());
        $this->assertEquals($this->personInvitePerson, $internalPersonPermission->getInvitePerson());
    }

    public function testGlobalPermission()
    {
        $globalPermission = PermissionRequest::myPermissions()->get();

        $this->assertEquals($this->churchCore_AdministerSettings, $globalPermission->getChurchcore()->getAdministerSettings());
        $this->assertEquals($this->churchDb_ViewBirthdaylist, $globalPermission->getChurchdb()->getViewBirthdaylist());
        $this->assertEquals($this->churchCal_AssistanceMode, $globalPermission->getChurchcal()->getAssistanceMode());
        $this->assertEquals($this->churchResource_CreateVirtualBookings, $globalPermission->getChurchresource()->getCreateVirtualBookings());
        $this->assertEquals($this->churchService_ViewHistory, $globalPermission->getChurchservice()->getViewHistory());
        $this->assertEquals($this->churchWiki_EditMasterdata, $globalPermission->getChurchwiki()->getEditMasterdata());
        $this->assertEquals($this->churchCheckin_CreatePerson, $globalPermission->getChurchcheckin()->getCreatePerson());
    }
}