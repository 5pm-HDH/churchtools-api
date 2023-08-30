<?php


namespace CTApi\Models\Groups\Person;


use CTApi\Models\Groups\Group\Group;
use CTApi\Models\Groups\Group\GroupRequest;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class PersonGroup
{
    use FillWithData;

    protected ?Group $group = null;
    protected ?int $groupTypeRoleId = null;
    protected ?string $memberStartDate = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "group":
                $this->group = Group::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public function requestGroup(): ?Group
    {
        $id = $this->getGroup()?->getId();
        if ($id != null) {
            return GroupRequest::find((int)$id);
        } else {
            return null;
        }
    }

    public function getMemberStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->memberStartDate);
    }

    /**
     * @return Group|null
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * @param Group|null $group
     * @return PersonGroup
     */
    public function setGroup(?Group $group): PersonGroup
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupTypeRoleId(): ?int
    {
        return $this->groupTypeRoleId;
    }

    /**
     * @param int|null $groupTypeRoleId
     * @return PersonGroup
     */
    public function setGroupTypeRoleId(?int $groupTypeRoleId): PersonGroup
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
     * @return PersonGroup
     */
    public function setMemberStartDate(?string $memberStartDate): PersonGroup
    {
        $this->memberStartDate = $memberStartDate;
        return $this;
    }
}