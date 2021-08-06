<?php


namespace CTApi\Requests;


use CTApi\Models\Event;
use CTApi\Models\Group;

class GroupRequest
{
    public static function all(): array
    {
        return (new GroupRequestBuilder())->all();
    }

    public static function where(string $key, $value): GroupRequestBuilder
    {
        return (new GroupRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): GroupRequestBuilder
    {
        return (new GroupRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): Group
    {
        return (new GroupRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Group
    {
        return (new GroupRequestBuilder())->find($id);
    }

}