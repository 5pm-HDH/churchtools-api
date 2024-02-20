<?php

namespace CTApi\Models\Groups\GroupType;

use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;

class GroupType extends AbstractModel
{
    use FillWithData;
    use MetaAttribute;


    protected ?bool $availableForNewPerson = null;
    protected ?bool $isLeaderNecessary = null;
    protected ?string $name = null;
    protected ?string $namePlural = null;
    protected ?string $namePluralTranslated = null;
    protected ?string $nameTranslated = null;
    protected ?int $permissionDepth = null;
    protected ?bool $postsEnabled = null;
    protected ?string $shorty = null;
    protected ?int $sortKey = null;
    protected ?string $description = null;

    /**
     * @param string|null $id
     * @return GroupType
     */
    public function setId(?string $id): GroupType
    {
        $this->id = $id;
        return $this;
    }

    public function getAvailableForNewPerson(): ?bool
    {
        return $this->availableForNewPerson;
    }

    public function setAvailableForNewPerson(?bool $availableForNewPerson): static
    {
        $this->availableForNewPerson = $availableForNewPerson;
        return $this;
    }

    public function getIsLeaderNecessary(): ?bool
    {
        return $this->isLeaderNecessary;
    }

    public function setIsLeaderNecessary(?bool $isLeaderNecessary): static
    {
        $this->isLeaderNecessary = $isLeaderNecessary;
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

    public function getNamePlural(): ?string
    {
        return $this->namePlural;
    }

    public function setNamePlural(?string $namePlural): static
    {
        $this->namePlural = $namePlural;
        return $this;
    }

    public function getNamePluralTranslated(): ?string
    {
        return $this->namePluralTranslated;
    }

    public function setNamePluralTranslated(?string $namePluralTranslated): static
    {
        $this->namePluralTranslated = $namePluralTranslated;
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

    public function getPermissionDepth(): ?int
    {
        return $this->permissionDepth;
    }

    public function setPermissionDepth(?int $permissionDepth): static
    {
        $this->permissionDepth = $permissionDepth;
        return $this;
    }

    public function getPostsEnabled(): ?bool
    {
        return $this->postsEnabled;
    }

    public function setPostsEnabled(?bool $postsEnabled)
    {
        $this->postsEnabled = $postsEnabled;
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

    public function getSortKey(): ?int
    {
        return $this->sortKey;
    }

    public function setSortKey(?int $sortKey): static
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): GroupType
    {
        $this->description = $description;
        return $this;
    }
}
