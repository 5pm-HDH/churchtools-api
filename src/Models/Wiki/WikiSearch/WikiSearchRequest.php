<?php


namespace CTApi\Models\Wiki\WikiSearch;


class WikiSearchRequest
{
    public static function search(string $query): WikiSearchRequestBuilder
    {
        return (new WikiSearchRequestBuilder())->search($query);
    }
}