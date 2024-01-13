<?php

namespace CTApi\Models\Groups\GroupTypeRole;


class GroupTypeRoleRequest
{
    public static function all(): array
    {
        return (new GroupTypeRoleRequestBuilder())->all();
    }

    public static function where(string $key, $value): GroupTypeRoleRequestBuilder
    {
        return (new GroupTypeRoleRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): GroupTypeRoleRequestBuilder
    {
        return (new GroupTypeRoleRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): GroupTypeRole
    {
        return (new GroupTypeRoleRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?GroupType
    {
        return (new GroupTypeRoleRequestBuilder())->find($id);
    }
}
