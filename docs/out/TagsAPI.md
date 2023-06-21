# Tags-API

## Retrieve all tags

```php
        use CTApi\Models\Common\Tag\TagRequest;

        $personTags = TagRequest::allPersonTags();
        $songTags = TagRequest::allSongTags();

        $tagList = "";
        foreach ($songTags as $tag) {
            $tagList .= $tag->getName() . " (#" . $tag->getId() . "); ";
        }

        var_dump( $tagList);
        // Output: "Choral (#2); 5pm Songpool (#5); Deprecated (#8); Youth Songpool (#11); "


```

## Retrieve tags for song

```php
        use CTApi\Models\Events\Song\SongRequest;

        $song = SongRequest::findOrFail(21);
        $tags = $song->requestTags()?->get() ?? [];

        $tagList = "";
        foreach ($tags as $tag) {
            $tagList .= $tag->getName() . " (#" . $tag->getId() . "); ";
        }

        var_dump( $tagList);
        // Output: "5pm Songpool (#5); Youth Songpool (#11); "


```
