<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Events\Song\SongCommentRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class SongCommentRequestTest extends TestCaseHttpMocked
{

    public function testGetAllComments()
    {
        $comments = SongCommentRequest::getForSongArrangement(2);
        $comment = $comments[0];

        $this->assertEquals(2, $comment->getId());
        $this->assertEquals(3, $comment->getDomainId());
        $this->assertEquals("arrangement", $comment->getDomainType());
        $this->assertEquals("Ich finde den Song super!", $comment->getText());
        $this->assertEquals("2023-12-11 13:06:35", $comment->getMeta()?->getModifiedDate());
        $this->assertEquals(12, $comment->getMeta()?->getModifiedPerson()?->getId());

        $person = $comment->getMeta()?->requestModifiedPerson();

        $this->assertEquals("David", $person->getFirstName());
    }

    /**
     * @return void
     * @doesNotPerformAssertions
     */
    public function testCreateComments()
    {
        SongCommentRequest::create(2, "Die Tonart ist super für Sopran.");
    }

    /**
     * @return void
     * @doesNotPerformAssertions
     */
    public function testDeleteComments()
    {
        $comments = SongCommentRequest::getForSongArrangement(2);
        $comment = $comments[0];

        SongCommentRequest::delete($comment->getIdAsInteger());
    }

}