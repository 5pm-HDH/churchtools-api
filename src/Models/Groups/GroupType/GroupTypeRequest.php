<?php

namespace CTApi\Models\Groups\GroupType;

class GroupTypeRequest
{
    public static function all(): array
    {
        return (new GroupTypeRequestBuilder())->all();
    }

    public static function where(string $key, $value): GroupTypeRequestBuilder
    {
        return (new GroupTypeRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): GroupTypeRequestBuilder
    {
        return (new GroupTypeRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): GroupType
    {
        return (new GroupTypeRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?GroupType
    {
        return (new GroupTypeRequestBuilder())->find($id);
    }

}
