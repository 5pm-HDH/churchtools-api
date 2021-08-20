<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupMember
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $personId = null;
    protected ?Person $person = null;
    protected ?string $groupTypeRoleId = null;
    protected ?string $memberStartDate = null;
    protected ?string $comment = null;
    protected ?string $memberEndDate = null;
    protected ?string $waitinglistPosition = null;
    protected array $fields = [];


    protected function fillArrayType(string $key, array $data)
    {
        switch ($key) {
            case "person":
                $this->setPerson(Person::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return GroupMember
     */
    public function setId(?string $id): GroupMember
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    /**
     * @param string|null $personId
     * @return GroupMember
     */
    public function setPersonId(?string $personId): GroupMember
    {
        $this->personId = $personId;
        return $this;
    }

    /**
     * @return Person|null
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person|null $person
     * @return GroupMember
     */
    public function setPerson(?Person $person): GroupMember
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupTypeRoleId(): ?string
    {
        return $this->groupTypeRoleId;
    }

    /**
     * @param string|null $groupTypeRoleId
     * @return GroupMember
     */
    public function setGroupTypeRoleId(?string $groupTypeRoleId): GroupMember
    {
        $this->groupTypeRoleId = $groupTypeRoleId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMemberStartDate(): ?string
    {
        return $this->memberStartDate;
    }

    /**
     * @param string|null $memberStartDate
     * @return GroupMember
     */
    public function setMemberStartDate(?string $memberStartDate): GroupMember
    {
        $this->memberStartDate = $memberStartDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return GroupMember
     */
    public function setComment(?string $comment): GroupMember
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMemberEndDate(): ?string
    {
        return $this->memberEndDate;
    }

    /**
     * @param string|null $memberEndDate
     * @return GroupMember
     */
    public function setMemberEndDate(?string $memberEndDate): GroupMember
    {
        $this->memberEndDate = $memberEndDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWaitinglistPosition(): ?string
    {
        return $this->waitinglistPosition;
    }

    /**
     * @param string|null $waitinglistPosition
     * @return GroupMember
     */
    public function setWaitinglistPosition(?string $waitinglistPosition): GroupMember
    {
        $this->waitinglistPosition = $waitinglistPosition;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     * @return GroupMember
     */
    public function setFields(array $fields): GroupMember
    {
        $this->fields = $fields;
        return $this;
    }
}