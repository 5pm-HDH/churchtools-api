<?php


namespace CTApi\Models;


use CTApi\Models\Traits\DomainAttribute;
use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\WikiSearchRequestBuilder;

class WikiSearchResult
{
    use FillWithData, DomainAttribute;

    protected ?string $preview = null;

    public function requestWikiPage(): ?WikiPage
    {
        if (!is_null($this->getApiUrl())) {
            return WikiSearchRequestBuilder::requestWikiPageFromRawUrl( (string) $this->getApiUrl());
        }
        return null;
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