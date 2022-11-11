<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupMeetingMember
{
    use FillWithData;

    protected ?bool $isCheckedIn = null;
    protected ?string $status = null;
    protected ?GroupMember $member = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "member":
                $this->member = GroupMember::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    /**
     * @return bool|null
     */
    public function getIsCheckedIn(): ?bool
    {
        return $this->isCheckedIn;
    }

    /**
     * @param bool|null $isCheckedIn
     * @return GroupMeetingMember
     */
    public function setIsCheckedIn(?bool $isCheckedIn): GroupMeetingMember
    {
        $this->isCheckedIn = $isCheckedIn;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return GroupMeetingMember
     */
    public function setStatus(?string $status): GroupMeetingMember
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return GroupMember|null
     */
    public function getMember(): ?GroupMember
    {
        return $this->member;
    }

    /**
     * @param GroupMember|null $member
     * @return GroupMeetingMember
     */
    public function setMember(?GroupMember $member): GroupMeetingMember
    {
        $this->member = $member;
        return $this;
    }
}