<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Events\Song\SongCommentRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class SongCommentRequestTest extends TestCaseAuthenticated
{

    private int $arrangementId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->arrangementId = IntegrationTestData::getFilterAsInt("get_song_comments", "song_arrangement_id");
    }

    public function testGetSongArrangement()
    {
        $comments = SongCommentRequest::getForSongArrangement($this->arrangementId);

        $commentId = IntegrationTestData::getResultAsInt("get_song_comments", "any_comment.id");
        $foundComment = null;
        foreach ($comments as $comment) {
            if ($comment->getId() == $commentId) {
                $foundComment = $comment;
            }
        }
        $this->assertNotNull($foundComment);
        $this->assertEqualsTestData("get_song_comments", "any_comment.text", $foundComment->getText());
        $this->assertEqualsTestData("get_song_comments", "any_comment.modified_date", $foundComment->getMeta()?->getModifiedDate());
        $this->assertEqualsTestData("get_song_comments", "any_comment.modified_person_id", $foundComment->getMeta()?->getModifiedPerson()?->getIdAsInteger());
    }

    public function testCreateAndDeleteSongArrangement()
    {
        $arrangementId = IntegrationTestData::getFilterAsInt("create_and_delete_song_comments", "song_arrangement_id");
        SongCommentRequest::create($arrangementId, "Hello world!");

        $anyComment = null;
        $allComments = SongCommentRequest::getForSongArrangement($arrangementId);
        foreach ($allComments as $comment) {
            if ($comment->getText() === "Hello world!") {
                $anyComment = $comment;
            }
        }
        $this->assertNotNull($anyComment);

        // DELETE ALL COMMENTS
        foreach ($allComments as $comment) {
            SongCommentRequest::delete($comment->getIdAsInteger());
        }
        $allComments = SongCommentRequest::getForSongArrangement($arrangementId);
        $this->assertEquals(0, sizeof($allComments));
    }

}