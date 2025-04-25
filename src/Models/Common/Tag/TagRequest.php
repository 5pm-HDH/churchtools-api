<?php

namespace CTApi\Models\Common\Tag;

class TagRequest
{
    public static function allPersonTags(): array
    {
        return (new TagRequestBuilder("person"))->all();
    }

    public static function allSongTags(): array
    {
        return (new TagRequestBuilder("song"))->all();
    }
    
    public static function allGroupTags(): array
    {
        return (new TagRequestBuilder("group"))->all();
    }

    public static function findPersonTag(int $id): ?Tag
    {
        return (new TagRequestBuilder("person"))->find($id);
    }

    public static function findSongTag(int $id): ?Tag
    {
        return (new TagRequestBuilder("song"))->find($id);
    }
    
    public static function findGroupTag(int $id): ?Tag
    {
        return (new TagRequestBuilder("group"))->find($id);
    }

    public static function findPersonTagOrFail(int $id): Tag
    {
        return (new TagRequestBuilder("person"))->findOrFail($id);
    }

    public static function findSongTagOrFail(int $id): Tag
    {
        return (new TagRequestBuilder("song"))->findOrFail($id);
    }
    
    public static function findGroupTagOrFail(int $id): Tag
    {
        return (new TagRequestBuilder("group"))->findOrFail($id);
    }
}
