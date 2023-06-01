<?php


namespace Tests\Unit\Docs;


use Requests\DBFieldRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Unit\TestCaseHttpMocked;

class DBFieldRequestTest extends TestCaseHttpMocked
{
    public function testGetAllDBFields()
    {
        $dbFields = DBFieldRequest::all();
        $dbField5pmName = $dbFields[0];

        $this->assertEquals(141, $dbField5pmName->getId());
        $this->assertEquals("5pm Bezeichnung", $dbField5pmName->getName());
        $this->assertEquals("5pm_name", $dbField5pmName->getShorty());
        $this->assertEquals("5pm_name", $dbField5pmName->getColumn());
        $this->assertEquals(220, $dbField5pmName->getLength());
        $this->assertEquals("group", $dbField5pmName->getFieldCategory()?->getName());
        $this->assertEquals("f_group", $dbField5pmName->getFieldCategory()?->getInternCode());
        $this->assertEquals("cdb_gruppe", $dbField5pmName->getFieldCategory()?->getTable());
        $this->assertEquals(4, $dbField5pmName->getFieldCategory()?->getId());
        $this->assertEquals("Textfeld", $dbField5pmName->getFieldType()?->getName());
        $this->assertEquals("text", $dbField5pmName->getFieldType()?->getInternCode());
        $this->assertEquals(1, $dbField5pmName->getFieldType()?->getId());
        $this->assertEquals(true, $dbField5pmName->getIsActive());
        $this->assertEquals(false, $dbField5pmName->getIsNewPersonField());
        $this->assertEquals("", $dbField5pmName->getLineEnding());
        $this->assertEquals(1, $dbField5pmName->getSecurityLevel());
        $this->assertEquals(0, $dbField5pmName->getSortKey());
        $this->assertEquals(false, $dbField5pmName->getDeleteOnArchive());
        $this->assertEquals(true, $dbField5pmName->getNullable());
        $this->assertEquals(false, $dbField5pmName->getHideInFrontend());
        $this->assertEquals(false, $dbField5pmName->getNotConfigurable());
        $this->assertEquals(false, $dbField5pmName->getIsBasicInfo());
    }

    public function testGetDBField()
    {
        $dbField5pmName = DBFieldRequest::find(141);
        // or
        $dbField5pmName = DBFieldRequest::findOrFail(141);

        $this->assertEquals(141, $dbField5pmName->getId());
        $this->assertEquals("5pm Bezeichnung", $dbField5pmName->getName());
        // ...
    }
}