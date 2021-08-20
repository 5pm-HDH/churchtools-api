<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupRole
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $groupTypeId = null;
    protected ?string $name = null;
    protected ?string $shorty = null;
    protected ?string $sortKey = null;
    protected ?string $toDelete = null;
    protected ?string $hasRequested = null;
    protected ?string $isLeader = null;
    protected ?string $isDefault = null;
    protected ?string $isHidden = null;
    protected ?string $growPathId = null;
    protected ?string $groupTypeRoleId = null;
    protected ?string $forceTwoFactorAuth = null;
    protected ?string $isActive = null;
    protected ?string $canReadChat = null;
    protected ?string $canWriteChat = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return GroupRole
     */
    public function setId(?string $id): GroupRole
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupTypeId(): ?string
    {
        return $this->groupTypeId;
    }

    /**
     * @param string|null $groupTypeId
     * @return GroupRole
     */
    public function setGroupTypeId(?string $groupTypeId): GroupRole
    {
        $this->groupTypeId = $groupTypeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return GroupRole
     */
    public function setName(?string $name): GroupRole
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShorty(): ?string
    {
        return $this->shorty;
    }

    /**
     * @param string|null $shorty
     * @return GroupRole
     */
    public function setShorty(?string $shorty): GroupRole
    {
        $this->shorty = $shorty;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortKey(): ?string
    {
        return $this->sortKey;
    }

    /**
     * @param string|null $sortKey
     * @return GroupRole
     */
    public function setSortKey(?string $sortKey): GroupRole
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getToDelete(): ?string
    {
        return $this->toDelete;
    }

    /**
     * @param string|null $toDelete
     * @return GroupRole
     */
    public function setToDelete(?string $toDelete): GroupRole
    {
        $this->toDelete = $toDelete;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHasRequested(): ?string
    {
        return $this->hasRequested;
    }

    /**
     * @param string|null $hasRequested
     * @return GroupRole
     */
    public function setHasRequested(?string $hasRequested): GroupRole
    {
        $this->hasRequested = $hasRequested;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsLeader(): ?string
    {
        return $this->isLeader;
    }

    /**
     * @param string|null $isLeader
     * @return GroupRole
     */
    public function setIsLeader(?string $isLeader): GroupRole
    {
        $this->isLeader = $isLeader;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsDefault(): ?string
    {
        return $this->isDefault;
    }

    /**
     * @param string|null $isDefault
     * @return GroupRole
     */
    public function setIsDefault(?string $isDefault): GroupRole
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsHidden(): ?string
    {
        return $this->isHidden;
    }

    /**
     * @param string|null $isHidden
     * @return GroupRole
     */
    public function setIsHidden(?string $isHidden): GroupRole
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGrowPathId(): ?string
    {
        return $this->growPathId;
    }

    /**
     * @param string|null $growPathId
     * @return GroupRole
     */
    public function setGrowPathId(?string $growPathId): GroupRole
    {
        $this->growPathId = $growPathId;
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
     * @return GroupRole
     */
    public function setGroupTypeRoleId(?string $groupTypeRoleId): GroupRole
    {
        $this->groupTypeRoleId = $groupTypeRoleId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getForceTwoFactorAuth(): ?string
    {
        return $this->forceTwoFactorAuth;
    }

    /**
     * @param string|null $forceTwoFactorAuth
     * @return GroupRole
     */
    public function setForceTwoFactorAuth(?string $forceTwoFactorAuth): GroupRole
    {
        $this->forceTwoFactorAuth = $forceTwoFactorAuth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsActive(): ?string
    {
        return $this->isActive;
    }

    /**
     * @param string|null $isActive
     * @return GroupRole
     */
    public function setIsActive(?string $isActive): GroupRole
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCanReadChat(): ?string
    {
        return $this->canReadChat;
    }

    /**
     * @param string|null $canReadChat
     * @return GroupRole
     */
    public function setCanReadChat(?string $canReadChat): GroupRole
    {
        $this->canReadChat = $canReadChat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCanWriteChat(): ?string
    {
        return $this->canWriteChat;
    }

    /**
     * @param string|null $canWriteChat
     * @return GroupRole
     */
    public function setCanWriteChat(?string $canWriteChat): GroupRole
    {
        $this->canWriteChat = $canWriteChat;
        return $this;
    }

}