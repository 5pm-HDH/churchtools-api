<?php


namespace Tests\Unit\Docs;


use CTApi\CTConfig;
use CTApi\Requests\PermissionRequest;
use Tests\Unit\TestCaseHttpMocked;

class PermissionRequestTest extends TestCaseHttpMocked
{
    public function testGroupPermission()
    {
        $internalGroupPermission = PermissionRequest::forGroup(21)->get();

        $this->assertEquals(true, $internalGroupPermission->getSeeGroupTags());
        $this->assertEquals(true, $internalGroupPermission->getAddPerson());
        $this->assertEquals(true, $internalGroupPermission->getMailGroupMembers());
        // ... see InternalGroupPermission-Model
    }

    public function testPersonPermission()
    {
        $internalPersonPermission = PermissionRequest::forPerson(23)->get();

        $this->assertEquals(2, $internalPersonPermission->getSeePersons());
        $this->assertEquals(true, $internalPersonPermission->getInvitePerson());
        $this->assertEquals(true, $internalPersonPermission->getSeeTags());
        $this->assertEquals(true, $internalPersonPermission->getEditPersons());
        $this->assertEquals(true, $internalPersonPermission->getDoFollowup());
    }

    public function testGlobalPermission()
    {
        $globalPermission = PermissionRequest::myPermissions()->get();

        $this->assertEquals(true, $globalPermission->getChurchcore()?->getAdministerSettings());
        $this->assertEquals(false, $globalPermission->getChurchdb()?->getViewBirthdaylist());
        $this->assertEquals(true, $globalPermission->getChurchcal()?->getView());
        $this->assertEquals(false, $globalPermission->getChurchresource()?->getCreateVirtualBookings());
        $this->assertEquals(true, $globalPermission->getChurchservice()?->getEditTemplate());
        $this->assertEquals(true, $globalPermission->getChurchwiki()->getEditMasterdata());
        $this->assertEquals(false, $globalPermission->getChurchcheckin()?->getEditMasterdata());
    }

}