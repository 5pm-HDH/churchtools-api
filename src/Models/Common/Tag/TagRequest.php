<?php

namespace CTApi\Models\Common\Tag;

class TagRequest
{
    public static function allPersonTags(): array
    {
        return (new TagRequestBuilder("persons"))->all();
    }

    public static function allSongTags(): array
    {
        return (new TagRequestBuilder("songs"))->all();
    }

    public static function findPersonTag(int $id): ?Tag
    {
        return (new TagRequestBuilder("persons"))->find($id);
    }

    public static function findSongTag(int $id): ?Tag
    {
        return (new TagRequestBuilder("songs"))->find($id);
    }

    public static function findPersonTagOrFail(int $id): Tag
    {
        return (new TagRequestBuilder("persons"))->findOrFail($id);
    }

    public static function findSongTagOrFail(int $id): Tag
    {
        return (new TagRequestBuilder("songs"))->findOrFail($id);
    }
}
