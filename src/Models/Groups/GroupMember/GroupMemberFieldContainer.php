<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\Models\Common\DBField\DBField;
use CTApi\Models\Common\DBField\DBFieldContainer;
use CTApi\Traits\Model\FillWithData;

class GroupMemberFieldContainer
{
    use FillWithData;

    protected ?string $type = null;
    protected null|GroupMemberField|DBFieldContainer $field = null;
    protected ?int $sortKey = null;
    protected ?bool $requiredInRegistrationForm = null;

    private array $fieldData = [];

    protected function fillNonArrayType(string $key, $value): void
    {
        if($key == "type") {
            $this->type = $value;
            $this->loadFieldLazy();
        }
        $this->fillDefault($key, $value);
    }

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "field":
                $this->fieldData = $data;
                $this->loadFieldLazy();
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    private function loadFieldLazy()
    {
        if($this->type != null && $this->fieldData != null && $this->field == null) {
            switch ($this->type) {
                case "group":
                    $this->field = GroupMemberField::createModelFromData($this->fieldData);
                    break;
                case "person":
                    $this->field = DBFieldContainer::createModelFromData($this->fieldData);
                    break;
            }
        }
    }

    public function getDBFieldIfExists(): ?DBField
    {
        if(is_a($this->field, DBFieldContainer::class)) {
            return $this->field->getDbField();
        }
        return null;
    }

    public function getGroupMemberFieldIfExists(): ?GroupMemberField
    {
        if(is_a($this->field, GroupMemberField::class)) {
            return $this->field;
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return GroupMemberFieldContainer
     */
    public function setType(?string $type): GroupMemberFieldContainer
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return DBFieldContainer|GroupMemberField|null
     */
    public function getField(): GroupMemberField|DBFieldContainer|null
    {
        return $this->field;
    }

    /**
     * @param DBFieldContainer|GroupMemberField|null $field
     * @return GroupMemberFieldContainer
     */
    public function setField(GroupMemberField|DBFieldContainer|null $field): GroupMemberFieldContainer
    {
        $this->field = $field;
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
     * @return GroupMemberFieldContainer
     */
    public function setSortKey(?int $sortKey): GroupMemberFieldContainer
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRequiredInRegistrationForm(): ?bool
    {
        return $this->requiredInRegistrationForm;
    }

    /**
     * @param bool|null $requiredInRegistrationForm
     * @return GroupMemberFieldContainer
     */
    public function setRequiredInRegistrationForm(?bool $requiredInRegistrationForm): GroupMemberFieldContainer
    {
        $this->requiredInRegistrationForm = $requiredInRegistrationForm;
        return $this;
    }
}
