<?php


namespace CTApi\Requests;


use CTApi\Models\Song;

class SongRequest
{
    public static function all(): array
    {
        return (new SongRequestBuilder())->all();
    }

    public static function where(string $key, $value): SongRequestBuilder
    {
        return (new SongRequestBuilder())->where($key, $value);
    }

    public static function orderBy(string $key, $orderAscending = true): SongRequestBuilder
    {
        return (new SongRequestBuilder())->orderBy($key, $orderAscending);
    }

    public static function findOrFail(int $id): Song
    {
        return (new SongRequestBuilder())->findOrFail($id);
    }

    public static function find(int $id): ?Song
    {
        return (new SongRequestBuilder())->find($id);
    }

}