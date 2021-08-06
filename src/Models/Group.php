<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Group
{
    use FillWithData;

    protected ?string $title;
    protected ?string $domainType;
    protected ?string $domainIdentifier;
    protected ?string $apiUrl;
    protected ?string $frontendUrl;
    protected ?string $imageUrl;
    protected array $domainAttributes = [];

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Group
     */
    public function setTitle(?string $title): Group
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomainType(): ?string
    {
        return $this->domainType;
    }

    /**
     * @param string|null $domainType
     * @return Group
     */
    public function setDomainType(?string $domainType): Group
    {
        $this->domainType = $domainType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomainIdentifier(): ?string
    {
        return $this->domainIdentifier;
    }

    /**
     * @param string|null $domainIdentifier
     * @return Group
     */
    public function setDomainIdentifier(?string $domainIdentifier): Group
    {
        $this->domainIdentifier = $domainIdentifier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    /**
     * @param string|null $apiUrl
     * @return Group
     */
    public function setApiUrl(?string $apiUrl): Group
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFrontendUrl(): ?string
    {
        return $this->frontendUrl;
    }

    /**
     * @param string|null $frontendUrl
     * @return Group
     */
    public function setFrontendUrl(?string $frontendUrl): Group
    {
        $this->frontendUrl = $frontendUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return Group
     */
    public function setImageUrl(?string $imageUrl): Group
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
     * @return Group
     */
    public function setDomainAttributes(array $domainAttributes): Group
    {
        $this->domainAttributes = $domainAttributes;
        return $this;
    }
}