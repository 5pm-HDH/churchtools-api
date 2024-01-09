<?php

namespace CTApi\Models\Calendars\Resource;

class ResourceRequest
{
    public static function all(): array
    {
        return (new ResourceRequestBuilder())->all();
    }
}
