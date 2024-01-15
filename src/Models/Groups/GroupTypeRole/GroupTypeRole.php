<?php

namespace CTApi\Models\Groups\GroupTypeRole;

use CTApi\Models\AbstractModel;
use CTApi\Models\Groups\GroupType\GroupType;
use CTApi\Models\Groups\GroupType\GroupTypeRequest;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;

class GroupTypeRole extends AbstractModel
{
    use FillWithData;
    use MetaAttribute;

    protected ?int $groupTypeId = null;
    protected ?int $growPathId = null;
    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $shorty = null;
    protected ?string $type = null;
    protected ?bool $isDefault = null;
    protected ?bool $isHidden = null;
    protected ?bool $isLeader = null;
    protected ?int $sortKey = null;

    public function setId(?string $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function requestGroupType(): ?GroupType
    {
        if($this->groupTypeId != null) {
            return GroupTypeRequest::find((int) $this->groupTypeId);
        }
        return null;
    }

    public function getGroupTypeId(): ?int
    {
        return $this->groupTypeId;
    }

    public function setGroupTypeId(?int $groupTypeId)
    {
        $this->groupTypeId = $groupTypeId;
        return $this;
    }

    public function getGrowPathId(): ?int
    {
        return $this->growPathId;
    }

    public function setGrowPathId(?int $growPathId)
    {
        $this->growPathId = $growPathId;
        return $this;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getNameTranslated(): ?string
    {
        return $this->nameTranslated;
    }

    public function setNameTranslated(?string $nameTranslated): static
    {
        $this->nameTranslated = $nameTranslated;
        return $this;
    }

    public function getShorty(): ?string
    {
        return $this->shorty;
    }

    public function setShorty(?string $shorty): static
    {
        $this->shorty = $shorty;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(?bool $isDefault): static
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    public function setIsHidden(?bool $isHidden): static
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    public function getIsLeader(): ?bool
    {
        return $this->isLeader;
    }

    public function setIsLeader(?bool $isLeader): static
    {
        $this->isLeader = $isLeader;
        return $this;
    }

    public function getSortKey(): ?int
    {
        return $this->sortKey;
    }

    public function setSortKey(?int $sortKey): static
    {
        $this->sortKey = $sortKey;
        return $this;
    }
}
