<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\WikiSearchRequestBuilder;

class WikiSearchResult
{
    use FillWithData;

    protected ?string $title = null;
    protected ?string $domainType = null;
    protected ?string $domainIdentifier = null;
    protected ?string $apiUrl = null;
    protected ?string $frontendUrl = null;
    protected ?string $imageUrl = null;
    protected ?array $domainAttributes = [];
    protected ?string $preview = null;

    public function requestWikiPage(): ?WikiPage
    {
        if (!is_null($this->getApiUrl())) {
            return WikiSearchRequestBuilder::requestWikiPageFromRawUrl($this->getApiUrl());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return WikiSearchResult
     */
    public function setTitle(?string $title): WikiSearchResult
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
     * @return WikiSearchResult
     */
    public function setDomainType(?string $domainType): WikiSearchResult
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
     * @return WikiSearchResult
     */
    public function setDomainIdentifier(?string $domainIdentifier): WikiSearchResult
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
     * @return WikiSearchResult
     */
    public function setApiUrl(?string $apiUrl): WikiSearchResult
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
     * @return WikiSearchResult
     */
    public function setFrontendUrl(?string $frontendUrl): WikiSearchResult
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
     * @return WikiSearchResult
     */
    public function setImageUrl(?string $imageUrl): WikiSearchResult
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getDomainAttributes(): ?array
    {
        return $this->domainAttributes;
    }

    /**
     * @param array|null $domainAttributes
     * @return WikiSearchResult
     */
    public function setDomainAttributes(?array $domainAttributes): WikiSearchResult
    {
        $this->domainAttributes = $domainAttributes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param string|null $preview
     * @return WikiSearchResult
     */
    public function setPreview(?string $preview): WikiSearchResult
    {
        $this->preview = $preview;
        return $this;
    }
}