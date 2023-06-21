<?php


namespace CTApi\Models\Wiki\WikiSearch;


use CTApi\Models\Wiki\WikiPage\WikiPage;
use CTApi\Traits\Model\DomainAttribute;
use CTApi\Traits\Model\FillWithData;

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