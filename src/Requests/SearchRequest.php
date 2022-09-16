<?php


namespace CTApi\Requests;


class SearchRequest
{
    public static function search(string $query)
    {
        return new SearchRequestBuilder($query);
    }
}