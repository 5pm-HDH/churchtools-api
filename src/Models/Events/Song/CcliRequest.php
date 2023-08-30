<?php


namespace CTApi\Models\Events\Song;


class CcliRequest
{
    public static function forSong(int $ccliNumber): CcliRequestBuilder
    {
        return new CcliRequestBuilder($ccliNumber);
    }
}