<?php

namespace CTApi\Models\Events\Service;

class ServiceRequest
{
    public static function all(): array
    {
        return (new ServiceRequestBuilder())->all();
    }

    public static function findOrFail(int $id): Service
    {
        return (new ServiceRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Service
    {
        return (new ServiceRequestBuilder())->find($id);
    }

}
