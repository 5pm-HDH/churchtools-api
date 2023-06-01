<?php


namespace Tests\Integration\Requests;


use Models\DBField;
use Requests\DBFieldRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class DBFieldRequestTest extends TestCaseAuthenticated
{

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

}