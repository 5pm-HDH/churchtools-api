<?php


namespace CTApi\Requests;


class CcliRequest
{
    public static function forSong(int $ccliNumber): CcliRequestBuilder
    {
        return new CcliRequestBuilder($ccliNumber);
    }
}