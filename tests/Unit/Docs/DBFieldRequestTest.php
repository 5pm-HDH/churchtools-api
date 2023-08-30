<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\CTConfig;
use CTApi\Models\Common\DBField\DBFieldRequest;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

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

    public function testReadGroupDBField()
    {
        CTConfig::enableDebugging();
        $group = GroupRequest::findOrFail(9);
        $groupInformation = $group->getInformation();

        /**
         * Get all DB-Field keys:
         */
        $dbFieldKeys = $groupInformation?->getDBFieldKeys() ?? [];
        $dbFieldKeysList = implode("; ", $dbFieldKeys);

        $this->assertEquals("color; 5pm_name", $dbFieldKeysList);

        /**
         * Get DB-Field data:
         */
        $dbFieldData = "";
        foreach ($groupInformation?->getDBFieldData() ?? [] as $dbFieldKey => $dbFieldValue) {
            $dbFieldData .= $dbFieldKey . "=" . $dbFieldValue . "; ";
        }
        $this->assertEquals("color=; 5pm_name=Worship-Team; ", $dbFieldData);

        /**
         * Get DB-Field data with DBModel
         */
        $dbFieldNames = "";

        $dbFieldContainerList = $groupInformation?->requestDBFields()->get();

        foreach ($dbFieldContainerList as $dbFieldValueContainer) {
            // $dbFieldValueContainer is from Type "DBFieldValueContainer"
            $dbFieldKey = $dbFieldValueContainer->getDBFieldKey();
            $dbFieldValue = $dbFieldValueContainer->getDBFieldValue();
            $dbField = $dbFieldValueContainer->getDBField();

            $dbFieldNames .= $dbField->getName() . "; ";
            // see: DBField-Model
        }
        $this->assertEquals("color; 5pm Bezeichnung; ", $dbFieldNames);
    }

    public function testDBFieldsPerson()
    {
        $person = PersonRequest::findOrFail(12);
        $dbFieldContainerList = $person->requestDBFields()->get();
        $dbFieldValueContainer = $dbFieldContainerList[0];

        $key = $dbFieldValueContainer->getDBFieldKey();
        $value = $dbFieldValueContainer->getDBFieldValue();

        $this->assertEquals("5pm_first_contact", $key);
        $this->assertEquals("1629-06-01", $value);

        $dbFieldFirstContact = $dbFieldValueContainer->getDBField();

        $this->assertEquals(142, $dbFieldFirstContact->getId());
        $this->assertEquals("Erstkontakt (5pm)", $dbFieldFirstContact->getName());
        $this->assertEquals("first_contact", $dbFieldFirstContact->getShorty());
        $this->assertEquals("5pm_first_contact", $dbFieldFirstContact->getColumn());
        $this->assertEquals(20, $dbFieldFirstContact->getLength());

    }
}