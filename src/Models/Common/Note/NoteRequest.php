<?php

namespace CTApi\Models\Common\Note;

class NoteRequest
{
    public static function forGroup(int $groupId): NoteRequestBuilder
    {
        return new NoteRequestBuilder("group", $groupId);
    }

    public static function forSongArrangement(int $songArrangementId): NoteRequestBuilder
    {
        return new NoteRequestBuilder("song_arrangement", $songArrangementId);
    }
}
