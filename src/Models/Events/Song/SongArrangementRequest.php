<?php

namespace CTApi\Models\Events\Song;

class SongArrangementRequest
{
    public static function update(SongArrangement $songArrangement): void
    {
        (new SongArrangementUpdateRequestBuilder())->update($songArrangement);
    }
}
