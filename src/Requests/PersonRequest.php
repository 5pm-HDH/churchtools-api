<?php


namespace CTApi\Requests;

use CTApi\Models\Person;

class PersonRequest
{
    public static function whoami(): Person
    {
        return (new PersonRequestBuilder())->whoami();
    }

    public static function all(): array
    {
        return (new PersonRequestBuilder())->all();
    }

    public static function where(string $key, $value): PersonRequestBuilder
    {
        return (new PersonRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): PersonRequestBuilder
    {
        return (new PersonRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): Person
    {
        return (new PersonRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Person
    {
        return (new PersonRequestBuilder())->find($id);
    }

}