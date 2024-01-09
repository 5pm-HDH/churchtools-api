<?php

namespace CTApi\Models\Common\Search;

class SearchRequest
{
    public static function search(string $query)
    {
        return new SearchRequestBuilder($query);
    }
}
