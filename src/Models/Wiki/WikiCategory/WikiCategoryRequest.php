<?php

namespace CTApi\Models\Wiki\WikiCategory;

class WikiCategoryRequest
{
    public static function all(): array
    {
        return (new WikiCategoryRequestBuilder())->all();
    }

    public static function findOrFail(int $id): WikiCategory
    {
        return (new WikiCategoryRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?WikiCategory
    {
        return (new WikiCategoryRequestBuilder())->find($id);
    }
}
