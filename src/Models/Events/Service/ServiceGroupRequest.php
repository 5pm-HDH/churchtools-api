<?php

namespace CTApi\Models\Events\Service;

class ServiceGroupRequest
{
    public static function all(): array
    {
        return (new ServiceGroupRequestBuilder())->all();
    }

    public static function findOrFail(int $id): ServiceGroup
    {
        return (new ServiceGroupRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?ServiceGroup
    {
        return (new ServiceGroupRequestBuilder())->find($id);
    }


}
