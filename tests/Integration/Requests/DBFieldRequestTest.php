<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Models\Common\DBField\DBField;
use CTApi\Models\Common\DBField\DBFieldRequest;
use CTApi\Models\Common\DBField\DBFieldValueContainer;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class DBFieldRequestTest extends TestCaseAuthenticated
{
    public static function setUpBeforeClass(): void
    {
        self::markTestSkipped("Fix issue with test in: https://github.com/5pm-HDH/churchtools-api/issues/184");
        parent::setUpBeforeClass();  // @phpstan-ignore-line
    }

    public function testRequestAll()
    {
        $dbFields = DBFieldRequest::all();

        $dbField5pmName = null;
        foreach ($dbFields as $dbField) {
            if (is_a($dbField, DBField::class)) {
                if ($dbField->getIdAsInteger() === IntegrationTestData::getResult("get_db_fields", "any_db_field.id")) {
                    $dbField5pmName = $dbField;
                }
            }
        }

        $this->validateDBField($dbField5pmName);
    }

    private function validateDBField(?DBField $dbField5pmName)
    {
        $this->assertNotNull($dbField5pmName);
        $this->assertEqualsTestData("get_db_fields", "any_db_field.id", $dbField5pmName->getId());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.name", $dbField5pmName->getName());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.shorty", $dbField5pmName->getShorty());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.column", $dbField5pmName->getColumn());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.length", $dbField5pmName->getLength());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldCategory.name", $dbField5pmName->getFieldCategory()?->getName());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldCategory.internCode", $dbField5pmName->getFieldCategory()?->getInternCode());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldCategory.table", $dbField5pmName->getFieldCategory()?->getTable());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldCategory.id", $dbField5pmName->getFieldCategory()?->getId());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldType.name", $dbField5pmName->getFieldType()?->getName());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldType.internCode", $dbField5pmName->getFieldType()?->getInternCode());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.fieldType.id", $dbField5pmName->getFieldType()?->getId());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.isActive", $dbField5pmName->getIsActive());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.isNewPersonField", $dbField5pmName->getIsNewPersonField());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.lineEnding", $dbField5pmName->getLineEnding());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.securityLevel", $dbField5pmName->getSecurityLevel());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.sortKey", $dbField5pmName->getSortKey());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.deleteOnArchive", $dbField5pmName->getDeleteOnArchive());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.nullable", $dbField5pmName->getNullable());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.hideInFrontend", $dbField5pmName->getHideInFrontend());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.notConfigurable", $dbField5pmName->getNotConfigurable());
        $this->assertEqualsTestData("get_db_fields", "any_db_field.isBasicInfo", $dbField5pmName->getIsBasicInfo());
    }

    public function testRetrieveOne()
    {
        $dbField5pmName = DBFieldRequest::find(IntegrationTestData::getResultAsInt("get_db_fields", "any_db_field.id"));
        $this->validateDBField($dbField5pmName);
    }

    public function testRetrieveOneOrFail()
    {
        $dbField5pmName = DBFieldRequest::findOrFail(IntegrationTestData::getResultAsInt("get_db_fields", "any_db_field.id"));
        $this->validateDBField($dbField5pmName);
    }

    public function testRetrievePersonInformation()
    {
        $personId = IntegrationTestData::getFilterAsInt("db_field_person_information", "person_id");
        $person = PersonRequest::findOrFail($personId);

        $dbFields = $person->requestDBFields()->get();

        $this->assertDBFieldStoreOnlyContainsDBFields($dbFields);

        $firstContactDBField = null;
        foreach ($dbFields as $dbField) {
            if (is_a($dbField, DBFieldValueContainer::class)) {
                if ($dbField->getDBFieldKey() == IntegrationTestData::getFilter("db_field_person_information", "db_field")) {
                    $firstContactDBField = $dbField;
                }
            }
        }

        $this->assertNotNull($firstContactDBField);
        $this->assertNotNull($firstContactDBField->getDBField());
        $this->assertEqualsTestData("db_field_person_information", "db_field.id", $firstContactDBField->getDBField()->getIdAsInteger());
        $this->assertEqualsTestData("db_field_person_information", "db_field.name", $firstContactDBField->getDBField()->getName());
        $this->assertEqualsTestData("db_field_person_information", "value", $firstContactDBField->getDBFieldValue());
    }

    private function assertDBFieldStoreOnlyContainsDBFields($dbFields)
    {
        $validationErrors = [];
        $this->assertNotNull($dbFields);
        foreach ($dbFields as $dbFieldContainer) {
            $this->assertInstanceOf(DBFieldValueContainer::class, $dbFieldContainer);
            $dbField = $dbFieldContainer->getDBField();

            if ($dbField == null) {
                $validationErrors[] = "The DBField " . $dbFieldContainer->getDBFieldKey() . " dont have any DB-Field Object.";
            }
        }
        $this->assertEmpty($validationErrors, implode("\n", $validationErrors));
    }

    public function testRetrieveGroupInformation()
    {
        $this->markTestSkipped("Fix issue with test in: https://github.com/5pm-HDH/churchtools-api/issues/184");
        $groupId = IntegrationTestData::getFilterAsInt("db_field_group", "group_id"); // @phpstan-ignore-line

        $group = GroupRequest::findOrFail($groupId);
        $groupInformation = $group->getInformation();
        $this->assertNotNull($groupInformation);

        print_r($groupInformation);

        $dbFields = $groupInformation->requestDBFields()->get();
        $this->assertDBFieldStoreOnlyContainsDBFields($dbFields);

        print_r($dbFields);

        $name5pmDBField = null;
        foreach ($dbFields as $dbField) {
            if (is_a($dbField, DBFieldValueContainer::class)) {
                if ($dbField->getDBFieldKey() == IntegrationTestData::getFilter("db_field_group", "db_field")) {
                    $name5pmDBField = $dbField;
                }
            }
        }

        $this->assertNotNull($name5pmDBField);
        $this->assertNotNull($name5pmDBField->getDBField());
        $this->assertEqualsTestData("db_field_group", "db_field.id", $name5pmDBField->getDBField()->getIdAsInteger());
        $this->assertEqualsTestData("db_field_group", "db_field.name", $name5pmDBField->getDBField()->getName());
        $this->assertEqualsTestData("db_field_group", "value", $name5pmDBField->getDBFieldValue());
    }
}
