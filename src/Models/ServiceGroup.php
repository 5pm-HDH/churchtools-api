<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\ServiceFromServiceGroupBuilder;

class ServiceGroup
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $sortKey = null;
    protected ?string $viewAll = null;
    protected ?string $campusId = null;
    protected ?string $onlyVisibleInCampusFilter = null;

    public function requestServices(): ?ServiceFromServiceGroupBuilder
    {
        if (!is_null($this->getId())) {
            return new ServiceFromServiceGroupBuilder($this->getId());
        }
        return null;
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
     * @return ServiceGroup
     */
    public function setId(?string $id): ServiceGroup
    {
        $this->id = $id;
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
     * @return ServiceGroup
     */
    public function setName(?string $name): ServiceGroup
    {
        $this->name = $name;
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
     * @return ServiceGroup
     */
    public function setSortKey(?string $sortKey): ServiceGroup
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getViewAll(): ?string
    {
        return $this->viewAll;
    }

    /**
     * @param string|null $viewAll
     * @return ServiceGroup
     */
    public function setViewAll(?string $viewAll): ServiceGroup
    {
        $this->viewAll = $viewAll;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCampusId(): ?string
    {
        return $this->campusId;
    }

    /**
     * @param string|null $campusId
     * @return ServiceGroup
     */
    public function setCampusId(?string $campusId): ServiceGroup
    {
        $this->campusId = $campusId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOnlyVisibleInCampusFilter(): ?string
    {
        return $this->onlyVisibleInCampusFilter;
    }

    /**
     * @param string|null $onlyVisibleInCampusFilter
     * @return ServiceGroup
     */
    public function setOnlyVisibleInCampusFilter(?string $onlyVisibleInCampusFilter): ServiceGroup
    {
        $this->onlyVisibleInCampusFilter = $onlyVisibleInCampusFilter;
        return $this;
    }
}