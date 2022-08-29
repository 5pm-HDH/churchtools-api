<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupSettings
{
    use FillWithData;

    protected ?bool $isHidden = null;
    protected ?bool $isOpenForMembers = null;
    protected ?bool $allowSpouseRegistration = null;
    protected ?bool $allowChildRegistration = null;
    protected ?bool $allowSameEmailRegistration = null;
    protected ?bool $allowOtherRegistration = null;
    protected ?bool $autoAccept = null;
    protected ?bool $allowWaitinglist = null;
    protected ?string $waitinglistMaxPersons = null;
    protected ?bool $automaticMoveUp = null;
    protected ?bool $isPublic = null;
    protected array $groupMeeting = [];
    protected ?bool $qrCodeCheckin = null;
    protected array $newMember = [];

    /**
     * @return bool|null
     */
    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool|null $isHidden
     * @return GroupSettings
     */
    public function setIsHidden(?bool $isHidden): GroupSettings
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsOpenForMembers(): ?bool
    {
        return $this->isOpenForMembers;
    }

    /**
     * @param bool|null $isOpenForMembers
     * @return GroupSettings
     */
    public function setIsOpenForMembers(?bool $isOpenForMembers): GroupSettings
    {
        $this->isOpenForMembers = $isOpenForMembers;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowSpouseRegistration(): ?bool
    {
        return $this->allowSpouseRegistration;
    }

    /**
     * @param bool|null $allowSpouseRegistration
     * @return GroupSettings
     */
    public function setAllowSpouseRegistration(?bool $allowSpouseRegistration): GroupSettings
    {
        $this->allowSpouseRegistration = $allowSpouseRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowChildRegistration(): ?bool
    {
        return $this->allowChildRegistration;
    }

    /**
     * @param bool|null $allowChildRegistration
     * @return GroupSettings
     */
    public function setAllowChildRegistration(?bool $allowChildRegistration): GroupSettings
    {
        $this->allowChildRegistration = $allowChildRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowSameEmailRegistration(): ?bool
    {
        return $this->allowSameEmailRegistration;
    }

    /**
     * @param bool|null $allowSameEmailRegistration
     * @return GroupSettings
     */
    public function setAllowSameEmailRegistration(?bool $allowSameEmailRegistration): GroupSettings
    {
        $this->allowSameEmailRegistration = $allowSameEmailRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowOtherRegistration(): ?bool
    {
        return $this->allowOtherRegistration;
    }

    /**
     * @param bool|null $allowOtherRegistration
     * @return GroupSettings
     */
    public function setAllowOtherRegistration(?bool $allowOtherRegistration): GroupSettings
    {
        $this->allowOtherRegistration = $allowOtherRegistration;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAutoAccept(): ?bool
    {
        return $this->autoAccept;
    }

    /**
     * @param bool|null $autoAccept
     * @return GroupSettings
     */
    public function setAutoAccept(?bool $autoAccept): GroupSettings
    {
        $this->autoAccept = $autoAccept;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowWaitinglist(): ?bool
    {
        return $this->allowWaitinglist;
    }

    /**
     * @param bool|null $allowWaitinglist
     * @return GroupSettings
     */
    public function setAllowWaitinglist(?bool $allowWaitinglist): GroupSettings
    {
        $this->allowWaitinglist = $allowWaitinglist;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWaitinglistMaxPersons(): ?string
    {
        return $this->waitinglistMaxPersons;
    }

    /**
     * @param string|null $waitinglistMaxPersons
     * @return GroupSettings
     */
    public function setWaitinglistMaxPersons(?string $waitinglistMaxPersons): GroupSettings
    {
        $this->waitinglistMaxPersons = $waitinglistMaxPersons;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAutomaticMoveUp(): ?bool
    {
        return $this->automaticMoveUp;
    }

    /**
     * @param bool|null $automaticMoveUp
     * @return GroupSettings
     */
    public function setAutomaticMoveUp(?bool $automaticMoveUp): GroupSettings
    {
        $this->automaticMoveUp = $automaticMoveUp;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * @param bool|null $isPublic
     * @return GroupSettings
     */
    public function setIsPublic(?bool $isPublic): GroupSettings
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroupMeeting(): array
    {
        return $this->groupMeeting;
    }

    /**
     * @param array $groupMeeting
     * @return GroupSettings
     */
    public function setGroupMeeting(array $groupMeeting): GroupSettings
    {
        $this->groupMeeting = $groupMeeting;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getQrCodeCheckin(): ?bool
    {
        return $this->qrCodeCheckin;
    }

    /**
     * @param bool|null $qrCodeCheckin
     * @return GroupSettings
     */
    public function setQrCodeCheckin(?bool $qrCodeCheckin): GroupSettings
    {
        $this->qrCodeCheckin = $qrCodeCheckin;
        return $this;
    }

    /**
     * @return array
     */
    public function getNewMember(): array
    {
        return $this->newMember;
    }

    /**
     * @param array $newMember
     * @return GroupSettings
     */
    public function setNewMember(array $newMember): GroupSettings
    {
        $this->newMember = $newMember;
        return $this;
    }
}