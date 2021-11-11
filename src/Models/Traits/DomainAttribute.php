<?php


namespace CTApi\Models\Traits;


use CTApi\Models\Meta;

trait DomainAttribute
{
    protected ?String $title = null;
    protected ?String $domainType = null;
    protected ?String $domainIdentifier = null;
    protected ?String $apiUrl = null;
    protected ?String $frontendUrl = null;
    protected ?String $imageUrl = null;
    protected array $domainAttributes = [];

    /**
     * @return String|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param String|null $title
     * @return DomainAttribute
     */
    public function setTitle(?string $title): DomainAttribute
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getDomainType(): ?string
    {
        return $this->domainType;
    }

    /**
     * @param String|null $domainType
     * @return DomainAttribute
     */
    public function setDomainType(?string $domainType): DomainAttribute
    {
        $this->domainType = $domainType;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getDomainIdentifier(): ?string
    {
        return $this->domainIdentifier;
    }

    /**
     * @param String|null $domainIdentifier
     * @return DomainAttribute
     */
    public function setDomainIdentifier(?string $domainIdentifier): DomainAttribute
    {
        $this->domainIdentifier = $domainIdentifier;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    /**
     * @param String|null $apiUrl
     * @return DomainAttribute
     */
    public function setApiUrl(?string $apiUrl): DomainAttribute
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getFrontendUrl(): ?string
    {
        return $this->frontendUrl;
    }

    /**
     * @param String|null $frontendUrl
     * @return DomainAttribute
     */
    public function setFrontendUrl(?string $frontendUrl): DomainAttribute
    {
        $this->frontendUrl = $frontendUrl;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param String|null $imageUrl
     * @return DomainAttribute
     */
    public function setImageUrl(?string $imageUrl): DomainAttribute
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return array
     */
    public function getDomainAttributes(): array
    {
        return $this->domainAttributes;
    }

    /**
     * @param array $domainAttributes
     * @return DomainAttribute
     */
    public function setDomainAttributes(array $domainAttributes): DomainAttribute
    {
        $this->domainAttributes = $domainAttributes;
        return $this;
    }
}