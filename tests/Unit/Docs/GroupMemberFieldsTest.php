<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Groups\GroupMember\GroupMemberFieldsRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class GroupMemberFieldsTest extends TestCaseHttpMocked
{

    public function testGetFields()
    {
        $fields = GroupMemberFieldsRequest::forGroup(9)->get();

        /**
         * Array of GroupMemberFieldContainer. A GroupMemberFieldContainer can contain in either contain a Person-Field or a GroupMember-Field in its field-property (type: null|GroupMemberField|DBFieldContainer).
         */
        $personField = $fields[0];
        $memberField = $fields[1];
        // $thirdField = $fields[3];
        // ... = $fields[...];

        /**
         * Person Field (DB-Field)
         */
        // type can be "person" (Person-Fields) or "group" (Group-Member-Fields)
        $this->assertEquals("person", $personField->getType());

        // GroupMemberFieldContainer->getField() can contain DBField or GroupMemberField.
        $dbField = $personField->getDBFieldIfExists();
        $unknownField = $personField->getGroupMemberFieldIfExists();
        $this->assertEquals(null, $unknownField);

        $this->assertEquals("54", $dbField->getId());
        $this->assertEquals(54, $dbField->getIdAsInteger());

        $this->assertEquals("nickname", $dbField->getName());
        $this->assertEquals("Spitzname", $dbField->getNameTranslated());
        $this->assertEquals("spitzname", $dbField->getColumn());

        $this->assertEquals("f_address", $dbField->getFieldCategory()?->getInternCode());
        $this->assertEquals("text", $dbField->getFieldType()?->getInternCode());
        $this->assertEquals(1, $dbField->getFieldType()?->getId());

        $this->assertEquals("(%) ", $dbField->getLineEnding());
        $this->assertEquals(1, $dbField->getSecurityLevel());
        $this->assertEquals(30, $dbField->getLength());
        $this->assertEquals(3, $dbField->getSortKey());

        $this->assertEquals(true, $dbField->getIsActive());
        $this->assertEquals(false, $dbField->getIsNewPersonField());
        $this->assertEquals(false, $dbField->getDeleteOnArchive());
        $this->assertEquals(false, $dbField->getNullable());
        $this->assertEquals(false, $dbField->getHideInFrontend());
        $this->assertEquals(false, $dbField->getIsBasicInfo());

        $this->assertEquals([], $dbField->getOptions());

        /**
         * GroupMemberField
         */

        $this->assertEquals("group", $memberField->getType());

        $vocalRangeField = $memberField->getGroupMemberFieldIfExists();

        $this->assertEquals("vocal range", $vocalRangeField->getFieldName());
        $this->assertEquals("vocal range of person from key to key", $vocalRangeField->getNote());
        $this->assertEquals(1, $vocalRangeField->getSortKey());
        $this->assertEquals(1, $vocalRangeField->getFieldTypeId());
        $this->assertEquals("text", $vocalRangeField->getFieldTypeCode());
        $this->assertEquals(1, $vocalRangeField->getSecurityLevel());
        $this->assertEquals(null, $vocalRangeField->getDefaultValue());
        $this->assertEquals([], $vocalRangeField->getOptions());
    }

}