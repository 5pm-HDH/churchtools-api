<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Requests\PermissionRequest;
use CTApi\Requests\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;


use CTApi\Test\Integration\TestCaseAuthenticated;

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
        $this->groupId = IntegrationTestData::getFilter("permission_group", "group_id");
        $this->groupAddPersion = IntegrationTestData::getResult("permission_group", "add_person");

        $this->personInvitePerson = IntegrationTestData::getResult("permission_person", "invite_person");

        $this->churchCore_AdministerSettings = IntegrationTestData::getResult("permission_global", "core_administer_settings");
        $this->churchDb_ViewBirthdaylist = IntegrationTestData::getResult("permission_global", "db_view_birthdaylist");
        $this->churchCal_AssistanceMode = IntegrationTestData::getResult("permission_global", "cal_assistance_mode");
        $this->churchResource_CreateVirtualBookings = IntegrationTestData::getResult("permission_global", "resource_create_virtual_bookings");
        $this->churchService_ViewHistory = IntegrationTestData::getResult("permission_global", "service_view_history");
        $this->churchWiki_EditMasterdata = IntegrationTestData::getResult("permission_global", "wiki_edit_masterdata");
        $this->churchCheckin_CreatePerson = IntegrationTestData::getResult("permission_global", "checkin_create_person");
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