<?php


namespace CTApi\Models\Common\Search;


use CTApi\Traits\Model\DomainAttribute;
use CTApi\Traits\Model\FillWithData;

class SearchResult
{
    use FillWithData, DomainAttribute;

    protected ?string $icon = null;

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return SearchResult
     */
    public function setIcon(?string $icon): SearchResult
    {
        $this->icon = $icon;
        return $this;
    }
}