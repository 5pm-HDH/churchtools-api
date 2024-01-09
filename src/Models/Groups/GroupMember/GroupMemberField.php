<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;

class GroupMemberField extends AbstractModel
{
    use FillWithData;

    protected ?int $groupId = null;
    protected ?string $fieldName = null;
    protected ?string $note = null;
    protected ?int $sortKey = null;
    protected ?int $fieldTypeId = null;
    protected ?string $fieldTypeCode = null;
    protected ?int $securityLevel = null;
    protected ?string $defaultValue = null;
    protected array $options = [];

    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return GroupMemberField
     */
    public function setId(?string $id): GroupMemberField
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     * @return GroupMemberField
     */
    public function setGroupId(?int $groupId): GroupMemberField
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldName(): ?string
    {
        return $this->fieldName;
    }

    /**
     * @param string|null $fieldName
     * @return GroupMemberField
     */
    public function setFieldName(?string $fieldName): GroupMemberField
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return GroupMemberField
     */
    public function setNote(?string $note): GroupMemberField
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortKey(): ?int
    {
        return $this->sortKey;
    }

    /**
     * @param int|null $sortKey
     * @return GroupMemberField
     */
    public function setSortKey(?int $sortKey): GroupMemberField
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFieldTypeId(): ?int
    {
        return $this->fieldTypeId;
    }

    /**
     * @param int|null $fieldTypeId
     * @return GroupMemberField
     */
    public function setFieldTypeId(?int $fieldTypeId): GroupMemberField
    {
        $this->fieldTypeId = $fieldTypeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldTypeCode(): ?string
    {
        return $this->fieldTypeCode;
    }

    /**
     * @param string|null $fieldTypeCode
     * @return GroupMemberField
     */
    public function setFieldTypeCode(?string $fieldTypeCode): GroupMemberField
    {
        $this->fieldTypeCode = $fieldTypeCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSecurityLevel(): ?int
    {
        return $this->securityLevel;
    }

    /**
     * @param int|null $securityLevel
     * @return GroupMemberField
     */
    public function setSecurityLevel(?int $securityLevel): GroupMemberField
    {
        $this->securityLevel = $securityLevel;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @param string|null $defaultValue
     * @return GroupMemberField
     */
    public function setDefaultValue(?string $defaultValue): GroupMemberField
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return GroupMemberField
     */
    public function setOptions(array $options): GroupMemberField
    {
        $this->options = $options;
        return $this;
    }
}
