<?php


namespace integration\Requests;


use Models\GroupMemberFieldContainer;
use Requests\GroupMemberFieldsRequest;
use Tests\Integration\IntegrationTestCase;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class GroupMemberFieldsTest extends TestCaseAuthenticated
{
    private IntegrationTestCase $testCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testCase = IntegrationTestData::getTestCase("get_group_fields");
    }

    public function testRequestFields()
    {
        $fields = $this->requestFields();
        $this->assertEquals(sizeof($fields), $this->testCase->getResultAsInt("number_of_fields"));
    }

    private function requestFields(): array
    {
        $groupId = $this->testCase->getFilterAsInt("group_id");
        return GroupMemberFieldsRequest::forGroup($groupId)->get();
    }

    public function testPersonField()
    {
        $fields = $this->requestFields();

        $personNicknameField = null;
        foreach ($fields as $field) {
            if (is_a($field, GroupMemberFieldContainer::class)) {
                $dbField = $field->getDBFieldIfExists();
                if ($dbField != null && $dbField->getName() === $this->testCase->getResult("any_field.dbField.name")) {
                    $personNicknameField = $dbField;
                }
            }
        }

        $this->assertNotNull($personNicknameField);
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.id", $personNicknameField->getId());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.name", $personNicknameField->getName());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.column", $personNicknameField->getColumn());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.fieldCategoryCode", $personNicknameField->getFieldCategory()?->getInternCode());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.fieldTypeCode", $personNicknameField->getFieldType()?->getInternCode());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.fieldTypeId", $personNicknameField->getFieldType()?->getId());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.isActive", $personNicknameField->getIsActive());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.isNewPersonField", $personNicknameField->getIsNewPersonField());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.secLevel", $personNicknameField->getSecurityLevel());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.deleteOnArchive", $personNicknameField->getDeleteOnArchive());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.nullable", $personNicknameField->getNullable());
        $this->assertEqualsTestData("get_group_fields", "any_field.dbField.hideInFrontend", $personNicknameField->getHideInFrontend());
    }

    public function testGroupMemberField()
    {
        $fields = $this->requestFields();

        $vocalRangeField = null;
        foreach ($fields as $field) {
            if (is_a($field, GroupMemberFieldContainer::class)) {
                $groupMemberField = $field->getGroupMemberFieldIfExists();
                if ($groupMemberField != null && $groupMemberField->getIdAsInteger() === $this->testCase->getResult("any_other_field.id")) {
                    $vocalRangeField = $groupMemberField;
                }
            }
        }

        $this->assertNotNull($vocalRangeField);
        $this->assertEqualsTestData("get_group_fields", "any_other_field.id", $vocalRangeField->getId());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.fieldName", $vocalRangeField->getFieldName());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.note", $vocalRangeField->getNote());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.sortKey", $vocalRangeField->getSortKey());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.fieldTypeId", $vocalRangeField->getFieldTypeId());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.fieldTypeCode", $vocalRangeField->getFieldTypeCode());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.securityLevel", $vocalRangeField->getSecurityLevel());
        $this->assertEqualsTestData("get_group_fields", "any_other_field.defaultValue", $vocalRangeField->getDefaultValue());
    }
}