<?php


namespace CTApi\Requests;


use CTApi\Models\Song;
use CTApi\Models\SongStatistic;

class SongStatisticRequest
{
    public static function all(): array
    {
        return (new SongStatisticRequestBuilder())->all();
    }

    public static function findOrFail(string $id): SongStatistic
    {
        return (new SongStatisticRequestBuilder())->findOrFail($id);
    }

    public static function find(string $id): ?SongStatistic
    {
        return (new SongStatisticRequestBuilder())->find($id);
    }
}