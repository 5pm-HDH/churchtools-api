<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;

class GroupHomepage
{
    use FillWithData, MetaAttribute;

    protected ?string $id = null;
    protected ?string $parentGroup = null;
    protected ?string $isEnabled = null;
    protected ?string $showLeader = null;
    protected ?string $showGroupImages = null;
    protected ?string $showMap = null;
    protected ?string $showFilter = null;
    protected ?string $defaultView = null;
    protected ?string $sortBy = null;
    protected ?string $orderDirection = null;
    protected ?string $randomUrl = null;
    protected array $filter = [];
    protected ?Meta $meta = null;
    protected array $groups = [];

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "groups":
                $this->setGroups(PublicGroup::createModelsFromArray($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return GroupHomepage
     */
    public function setId(?string $id): GroupHomepage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getParentGroup(): ?string
    {
        return $this->parentGroup;
    }

    /**
     * @param string|null $parentGroup
     * @return GroupHomepage
     */
    public function setParentGroup(?string $parentGroup): GroupHomepage
    {
        $this->parentGroup = $parentGroup;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsEnabled(): ?string
    {
        return $this->isEnabled;
    }

    /**
     * @param string|null $isEnabled
     * @return GroupHomepage
     */
    public function setIsEnabled(?string $isEnabled): GroupHomepage
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowLeader(): ?string
    {
        return $this->showLeader;
    }

    /**
     * @param string|null $showLeader
     * @return GroupHomepage
     */
    public function setShowLeader(?string $showLeader): GroupHomepage
    {
        $this->showLeader = $showLeader;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowGroupImages(): ?string
    {
        return $this->showGroupImages;
    }

    /**
     * @param string|null $showGroupImages
     * @return GroupHomepage
     */
    public function setShowGroupImages(?string $showGroupImages): GroupHomepage
    {
        $this->showGroupImages = $showGroupImages;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowMap(): ?string
    {
        return $this->showMap;
    }

    /**
     * @param string|null $showMap
     * @return GroupHomepage
     */
    public function setShowMap(?string $showMap): GroupHomepage
    {
        $this->showMap = $showMap;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowFilter(): ?string
    {
        return $this->showFilter;
    }

    /**
     * @param string|null $showFilter
     * @return GroupHomepage
     */
    public function setShowFilter(?string $showFilter): GroupHomepage
    {
        $this->showFilter = $showFilter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultView(): ?string
    {
        return $this->defaultView;
    }

    /**
     * @param string|null $defaultView
     * @return GroupHomepage
     */
    public function setDefaultView(?string $defaultView): GroupHomepage
    {
        $this->defaultView = $defaultView;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @param string|null $sortBy
     * @return GroupHomepage
     */
    public function setSortBy(?string $sortBy): GroupHomepage
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    /**
     * @param string|null $orderDirection
     * @return GroupHomepage
     */
    public function setOrderDirection(?string $orderDirection): GroupHomepage
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRandomUrl(): ?string
    {
        return $this->randomUrl;
    }

    /**
     * @param string|null $randomUrl
     * @return GroupHomepage
     */
    public function setRandomUrl(?string $randomUrl): GroupHomepage
    {
        $this->randomUrl = $randomUrl;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }

    /**
     * @param array $filter
     * @return GroupHomepage
     */
    public function setFilter(array $filter): GroupHomepage
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return Meta|null
     */
    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    /**
     * @param Meta|null $meta
     * @return GroupHomepage
     */
    public function setMeta(?Meta $meta): GroupHomepage
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     * @return GroupHomepage
     */
    public function setGroups(array $groups): GroupHomepage
    {
        $this->groups = $groups;
        return $this;
    }
}