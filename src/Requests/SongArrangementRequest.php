<?php


namespace CTApi\Requests;


use CTApi\Models\SongArrangement;

class SongArrangementRequest
{
    public static function update(SongArrangement $songArrangement): void
    {
        (new SongArrangementUpdateRequestBuilder())->update($songArrangement);
    }
}