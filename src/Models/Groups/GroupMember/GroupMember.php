<?php


namespace CTApi\Models\Groups\GroupMember;


use CTApi\Interfaces\UpdatableModel;
use CTApi\Models\AbstractModel;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Traits\Model\ExtractData;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class GroupMember extends AbstractModel implements UpdatableModel
{
    use FillWithData, ExtractData;

    protected ?string $personId = null;
    protected ?Person $person = null;
    protected ?string $groupTypeRoleId = null;
    protected ?string $groupMemberStatus = null;
    protected ?string $followUpStep = null;
    protected ?string $followUpDiffDays = null;
    protected ?string $followUpUnsuccessfulBackGroupId = null;
    protected ?string $comment = null;
    protected ?string $memberStartDate = null;
    protected ?string $memberEndDate = null;
    protected ?string $waitinglistPosition = null;
    protected array $fields = [];
    protected array $personFields = [];


    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "person":
                $this->setPerson(Person::createModelFromData($data));
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    static function getModifiableAttributes(): array
    {
        return [
            "comment",
            "fields",
            "groupTypeRoleId",
            "memberEndDate",
            "memberStartDate",
            "waitinglistPos"
        ];
    }

    public function requestPerson(): ?Person
    {
        if ($this->getPersonId() != null) {
            return PersonRequest::find((int)$this->getPersonId());
        } else {
            return null;
        }
    }

    public function getMemberStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->memberStartDate);
    }

    public function getMemberEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->memberEndDate);
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

    /**
     * @return array
     */
    public function getPersonFields(): array
    {
        return $this->personFields;
    }

    /**
     * @param array $personFields
     * @return GroupMember
     */
    public function setPersonFields(array $personFields): GroupMember
    {
        $this->personFields = $personFields;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupMemberStatus(): ?string
    {
        return $this->groupMemberStatus;
    }

    /**
     * @param string|null $groupMemberStatus
     * @return GroupMember
     */
    public function setGroupMemberStatus(?string $groupMemberStatus): GroupMember
    {
        $this->groupMemberStatus = $groupMemberStatus;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFollowUpStep(): ?string
    {
        return $this->followUpStep;
    }

    /**
     * @param string|null $followUpStep
     * @return GroupMember
     */
    public function setFollowUpStep(?string $followUpStep): GroupMember
    {
        $this->followUpStep = $followUpStep;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFollowUpDiffDays(): ?string
    {
        return $this->followUpDiffDays;
    }

    /**
     * @param string|null $followUpDiffDays
     * @return GroupMember
     */
    public function setFollowUpDiffDays(?string $followUpDiffDays): GroupMember
    {
        $this->followUpDiffDays = $followUpDiffDays;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFollowUpUnsuccessfulBackGroupId(): ?string
    {
        return $this->followUpUnsuccessfulBackGroupId;
    }

    /**
     * @param string|null $followUpUnsuccessfulBackGroupId
     * @return GroupMember
     */
    public function setFollowUpUnsuccessfulBackGroupId(?string $followUpUnsuccessfulBackGroupId): GroupMember
    {
        $this->followUpUnsuccessfulBackGroupId = $followUpUnsuccessfulBackGroupId;
        return $this;
    }
}