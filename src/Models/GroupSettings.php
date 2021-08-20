<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupSettings
{
    use FillWithData;

    protected ?string $isHidden = null;
    protected ?string $isOpenForMembers = null;
    protected ?string $allowSpouseRegistration = null;
    protected ?string $allowChildRegistration = null;
    protected ?string $allowSameEmailRegistration = null;
    protected ?string $allowOtherRegistration = null;
    protected ?string $autoAccept = null;
    protected ?string $allowWaitinglist = null;
    protected ?string $waitinglistMaxPersons = null;
    protected ?string $automaticMoveUp = null;
    protected ?string $isPublic = null;
    protected array $groupMeeting = [];
    protected ?string $qrCodeCheckin = null;
    protected array $newMember = [];

    /**
     * @return string|null
     */
    public function getIsHidden(): ?string
    {
        return $this->isHidden;
    }

    /**
     * @param string|null $isHidden
     * @return GroupSettings
     */
    public function setIsHidden(?string $isHidden): GroupSettings
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsOpenForMembers(): ?string
    {
        return $this->isOpenForMembers;
    }

    /**
     * @param string|null $isOpenForMembers
     * @return GroupSettings
     */
    public function setIsOpenForMembers(?string $isOpenForMembers): GroupSettings
    {
        $this->isOpenForMembers = $isOpenForMembers;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowSpouseRegistration(): ?string
    {
        return $this->allowSpouseRegistration;
    }

    /**
     * @param string|null $allowSpouseRegistration
     * @return GroupSettings
     */
    public function setAllowSpouseRegistration(?string $allowSpouseRegistration): GroupSettings
    {
        $this->allowSpouseRegistration = $allowSpouseRegistration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowChildRegistration(): ?string
    {
        return $this->allowChildRegistration;
    }

    /**
     * @param string|null $allowChildRegistration
     * @return GroupSettings
     */
    public function setAllowChildRegistration(?string $allowChildRegistration): GroupSettings
    {
        $this->allowChildRegistration = $allowChildRegistration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowSameEmailRegistration(): ?string
    {
        return $this->allowSameEmailRegistration;
    }

    /**
     * @param string|null $allowSameEmailRegistration
     * @return GroupSettings
     */
    public function setAllowSameEmailRegistration(?string $allowSameEmailRegistration): GroupSettings
    {
        $this->allowSameEmailRegistration = $allowSameEmailRegistration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowOtherRegistration(): ?string
    {
        return $this->allowOtherRegistration;
    }

    /**
     * @param string|null $allowOtherRegistration
     * @return GroupSettings
     */
    public function setAllowOtherRegistration(?string $allowOtherRegistration): GroupSettings
    {
        $this->allowOtherRegistration = $allowOtherRegistration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAutoAccept(): ?string
    {
        return $this->autoAccept;
    }

    /**
     * @param string|null $autoAccept
     * @return GroupSettings
     */
    public function setAutoAccept(?string $autoAccept): GroupSettings
    {
        $this->autoAccept = $autoAccept;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowWaitinglist(): ?string
    {
        return $this->allowWaitinglist;
    }

    /**
     * @param string|null $allowWaitinglist
     * @return GroupSettings
     */
    public function setAllowWaitinglist(?string $allowWaitinglist): GroupSettings
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
     * @return string|null
     */
    public function getAutomaticMoveUp(): ?string
    {
        return $this->automaticMoveUp;
    }

    /**
     * @param string|null $automaticMoveUp
     * @return GroupSettings
     */
    public function setAutomaticMoveUp(?string $automaticMoveUp): GroupSettings
    {
        $this->automaticMoveUp = $automaticMoveUp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsPublic(): ?string
    {
        return $this->isPublic;
    }

    /**
     * @param string|null $isPublic
     * @return GroupSettings
     */
    public function setIsPublic(?string $isPublic): GroupSettings
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
     * @return string|null
     */
    public function getQrCodeCheckin(): ?string
    {
        return $this->qrCodeCheckin;
    }

    /**
     * @param string|null $qrCodeCheckin
     * @return GroupSettings
     */
    public function setQrCodeCheckin(?string $qrCodeCheckin): GroupSettings
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