<?php

namespace CTApi\Traits\Model;

trait DomainAttribute
{
    protected ?string $title = null;
    protected ?string $domainType = null;
    protected ?string $domainIdentifier = null;
    protected ?string $apiUrl = null;
    protected ?string $frontendUrl = null;
    protected ?string $imageUrl = null;
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
     * @return self
     */
    public function setTitle(?string $title): self
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
     * @return self
     */
    public function setDomainType(?string $domainType): self
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
     * @return self
     */
    public function setDomainIdentifier(?string $domainIdentifier): self
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
     * @return self
     */
    public function setApiUrl(?string $apiUrl): self
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
     * @return self
     */
    public function setFrontendUrl(?string $frontendUrl): self
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
     * @return self
     */
    public function setImageUrl(?string $imageUrl): self
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
     * @return self
     */
    public function setDomainAttributes(array $domainAttributes): self
    {
        $this->domainAttributes = $domainAttributes;
        return $this;
    }
}
