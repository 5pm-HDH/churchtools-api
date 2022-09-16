<?php


namespace CTApi\Models;


use CTApi\Models\Traits\DomainAttribute;
use CTApi\Models\Traits\FillWithData;

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