<?php


namespace CTApi\Requests;


use CTApi\Models\Event;

class EventRequest
{
    public static function all(): array
    {
        return (new EventRequestBuilder())->all();
    }

    public static function where(string $key, $value): EventRequestBuilder
    {
        return (new EventRequestBuilder())->where($key, $value);
    }

    public static function findOrFail(int $id): Event
    {
        return (new EventRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Event
    {
        return (new EventRequestBuilder())->find($id);
    }

}