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
    protected ?bool $toDelete = null;
    protected ?bool $hasRequested = null;
    protected ?bool $isLeader = null;
    protected ?bool $isDefault = null;
    protected ?bool $isHidden = null;
    protected ?string $growPathId = null;
    protected ?string $groupTypeRoleId = null;
    protected ?bool $forceTwoFactorAuth = null;
    protected ?bool $isActive = null;
    protected ?bool $canReadChat = null;
    protected ?bool $canWriteChat = null;

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
     * @return bool|null
     */
    public function getToDelete(): ?bool
    {
        return $this->toDelete;
    }

    /**
     * @param bool|null $toDelete
     * @return GroupRole
     */
    public function setToDelete(?bool $toDelete): GroupRole
    {
        $this->toDelete = $toDelete;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHasRequested(): ?bool
    {
        return $this->hasRequested;
    }

    /**
     * @param bool|null $hasRequested
     * @return GroupRole
     */
    public function setHasRequested(?bool $hasRequested): GroupRole
    {
        $this->hasRequested = $hasRequested;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsLeader(): ?bool
    {
        return $this->isLeader;
    }

    /**
     * @param bool|null $isLeader
     * @return GroupRole
     */
    public function setIsLeader(?bool $isLeader): GroupRole
    {
        $this->isLeader = $isLeader;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool|null $isDefault
     * @return GroupRole
     */
    public function setIsDefault(?bool $isDefault): GroupRole
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool|null $isHidden
     * @return GroupRole
     */
    public function setIsHidden(?bool $isHidden): GroupRole
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
     * @return bool|null
     */
    public function getForceTwoFactorAuth(): ?bool
    {
        return $this->forceTwoFactorAuth;
    }

    /**
     * @param bool|null $forceTwoFactorAuth
     * @return GroupRole
     */
    public function setForceTwoFactorAuth(?bool $forceTwoFactorAuth): GroupRole
    {
        $this->forceTwoFactorAuth = $forceTwoFactorAuth;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     * @return GroupRole
     */
    public function setIsActive(?bool $isActive): GroupRole
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanReadChat(): ?bool
    {
        return $this->canReadChat;
    }

    /**
     * @param bool|null $canReadChat
     * @return GroupRole
     */
    public function setCanReadChat(?bool $canReadChat): GroupRole
    {
        $this->canReadChat = $canReadChat;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanWriteChat(): ?bool
    {
        return $this->canWriteChat;
    }

    /**
     * @param bool|null $canWriteChat
     * @return GroupRole
     */
    public function setCanWriteChat(?bool $canWriteChat): GroupRole
    {
        $this->canWriteChat = $canWriteChat;
        return $this;
    }
}