<?php

namespace CTApi\Models\Calendars\Resource;

class ResourceRequest
{
    /**
     * @return Resource[]
     */
    public static function all(): array
    {
        return (new ResourceRequestBuilder())->all();
    }
}
