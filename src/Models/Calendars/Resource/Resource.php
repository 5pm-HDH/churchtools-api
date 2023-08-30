<?php


namespace CTApi\Models\Calendars\Resource;


use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;

class Resource extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;
    protected ?string $resourceTypeId = null;
    protected ?ResourceType $resourceType = null;
    protected ?string $location = null;
    protected ?string $iCalLocation = null;
    protected ?bool $isAutoAccept = null;
    protected ?bool $doesRequireCalEntry = null;
    protected ?bool $isVirtual = null;
    protected array $adminIds = [];
    protected ?string $randomString = null;

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "adminIds":
                // adminIds cannot be filled with non-array-type
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    public function requestBookings(): ?ResourceBookingsRequestBuilder
    {
        if ($this->getId() != null) {
            return new ResourceBookingsRequestBuilder([$this->getId()]);
        }
        return null;
    }

    /**
     * @param string|null $id
     * @return Resource
     */
    public function setId(?string $id): Resource
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
     * @return Resource
     */
    public function setName(?string $name): Resource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameTranslated(): ?string
    {
        return $this->nameTranslated;
    }

    /**
     * @param string|null $nameTranslated
     * @return Resource
     */
    public function setNameTranslated(?string $nameTranslated): Resource
    {
        $this->nameTranslated = $nameTranslated;
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
     * @return Resource
     */
    public function setSortKey(?string $sortKey): Resource
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getResourceTypeId(): ?string
    {
        return $this->resourceTypeId;
    }

    /**
     * @param string|null $resourceTypeId
     * @return Resource
     */
    public function setResourceTypeId(?string $resourceTypeId): Resource
    {
        $this->resourceTypeId = $resourceTypeId;
        return $this;
    }

    /**
     * @return ResourceType|null
     */
    public function getResourceType(): ?ResourceType
    {
        return $this->resourceType;
    }

    /**
     * @param ResourceType|null $resourceType
     * @return Resource
     */
    public function setResourceType(?ResourceType $resourceType): Resource
    {
        $this->resourceType = $resourceType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return Resource
     */
    public function setLocation(?string $location): Resource
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getICalLocation(): ?string
    {
        return $this->iCalLocation;
    }

    /**
     * @param string|null $iCalLocation
     * @return Resource
     */
    public function setICalLocation(?string $iCalLocation): Resource
    {
        $this->iCalLocation = $iCalLocation;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsAutoAccept(): ?bool
    {
        return $this->isAutoAccept;
    }

    /**
     * @param bool|null $isAutoAccept
     * @return Resource
     */
    public function setIsAutoAccept(?bool $isAutoAccept): Resource
    {
        $this->isAutoAccept = $isAutoAccept;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDoesRequireCalEntry(): ?bool
    {
        return $this->doesRequireCalEntry;
    }

    /**
     * @param bool|null $doesRequireCalEntry
     * @return Resource
     */
    public function setDoesRequireCalEntry(?bool $doesRequireCalEntry): Resource
    {
        $this->doesRequireCalEntry = $doesRequireCalEntry;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsVirtual(): ?bool
    {
        return $this->isVirtual;
    }

    /**
     * @param bool|null $isVirtual
     * @return Resource
     */
    public function setIsVirtual(?bool $isVirtual): Resource
    {
        $this->isVirtual = $isVirtual;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdminIds(): array
    {
        return $this->adminIds;
    }

    /**
     * @param array $adminIds
     * @return Resource
     */
    public function setAdminIds(array $adminIds): Resource
    {
        $this->adminIds = $adminIds;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRandomString(): ?string
    {
        return $this->randomString;
    }

    /**
     * @param string|null $randomString
     * @return Resource
     */
    public function setRandomString(?string $randomString): Resource
    {
        $this->randomString = $randomString;
        return $this;
    }
}