<?php


namespace CTApi\Requests;


class FileRequest
{
    public static function forAvatar(int $personId): FileRequestBuilder
    {
        return new FileRequestBuilder("avatar", $personId);
    }
}