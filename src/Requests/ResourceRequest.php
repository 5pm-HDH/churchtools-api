<?php


namespace CTApi\Requests;


class ResourceRequest
{
    public static function all(): array
    {
        return (new ResourceRequestBuilder())->all();
    }
}