<?php


namespace CTApi\Requests;


class WikiSearchRequest
{
    public static function search(string $query): WikiSearchRequestBuilder
    {
        return (new WikiSearchRequestBuilder())->search($query);
    }
}