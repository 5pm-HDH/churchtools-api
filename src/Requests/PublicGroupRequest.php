<?php


namespace CTApi\Requests;


use CTApi\Models\GroupHomepage;

class PublicGroupRequest
{
    public static function get(string $hashString): GroupHomepage
    {
        return (new PublicGroupRequestBuilder($hashString))->get();
    }
}