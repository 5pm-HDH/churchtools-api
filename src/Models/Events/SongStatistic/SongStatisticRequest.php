<?php

namespace CTApi\Models\Events\SongStatistic;

class SongStatisticRequest
{
    /**
     * @return SongStatistic[]
     */
    public static function all(): array
    {
        return (new SongStatisticRequestBuilder())->all();
    }

    public static function findOrFail(string $arrangementId): SongStatistic
    {
        return (new SongStatisticRequestBuilder())->findOrFail($arrangementId);
    }

    public static function find(string $arrangementId): ?SongStatistic
    {
        return (new SongStatisticRequestBuilder())->find($arrangementId);
    }
}
