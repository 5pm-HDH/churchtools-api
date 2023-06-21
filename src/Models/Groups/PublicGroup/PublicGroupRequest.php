<?php


namespace CTApi\Models\Groups\PublicGroup;


use CTApi\Models\Groups\Group\GroupHomepage;

class PublicGroupRequest
{
    public static function get(string $hashString): GroupHomepage
    {
        return (new PublicGroupRequestBuilder($hashString))->get();
    }
}