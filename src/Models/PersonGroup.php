<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class PersonGroup
{
    use FillWithData;

    protected ?Group $group;
    protected ?int $groupTypeRoleId;
    protected ?string $memberStartDate;

    protected function fillArrayType(string $key, array $data)
    {
        if($key == 'group'){
            $this->group = Group::createModelFromData($data);
        }
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