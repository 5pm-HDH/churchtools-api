<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Common\Tag\TagRequest;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class TagsRequestTest extends TestCaseHttpMocked
{
    public function testRetrieveTags()
    {
        $personTags = TagRequest::allPersonTags();
        $songTags = TagRequest::allSongTags();

        $tagList = "";
        foreach ($songTags as $tag) {
            $tagList .= $tag->getName() . " (#" . $tag->getId() . "); ";
        }

        $this->assertEquals("Choral (#2); 5pm Songpool (#5); Deprecated (#8); Youth Songpool (#11); ", $tagList);
    }

    public function testRetrieveTagForSong()
    {
        $song = SongRequest::findOrFail(21);
        $tags = $song->requestTags()?->get() ?? [];

        $tagList = "";
        foreach ($tags as $tag) {
            $tagList .= $tag->getName() . " (#" . $tag->getId() . "); ";
        }

        $this->assertEquals("5pm Songpool (#5); Youth Songpool (#11); ", $tagList);
    }

}
