<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTLog;
use CTApi\Models\Common\Note\NoteRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class NoteRequestTest extends TestCaseAuthenticated
{
    public function testNotForGroup()
    {
        CTLog::enableHttpLog();
        // Remove all notes from group
        $groupId = IntegrationTestData::getFilterAsInt("group_note", "group_id");

        $notes = NoteRequest::forGroup($groupId)->get();
        foreach($notes as $note) {
            NoteRequest::forGroup($groupId)->delete($note->getIdAsInteger());
        }

        $notes = NoteRequest::forGroup($groupId)->get();
        $this->assertEmpty($notes);

        // Add one note
        $note = NoteRequest::forGroup($groupId)->create("Hello new comment!");
        $this->assertEquals("Hello new comment!", $note->getText());

        $noteUpdate =  NoteRequest::forGroup($groupId)->update($note->getIdAsInteger(), "Hello comment!");
        $this->assertEquals("Hello comment!", $noteUpdate->getText());

        // Check if note is present
        $notes = NoteRequest::forGroup($groupId)->get();
        $this->assertEquals(1, sizeof($notes));
        $firstNote = end($notes);

        $this->assertEquals("Hello comment!", $firstNote->getText());
    }

    public function testForSongArrangement()
    {
        // Remove all notes from group
        $songArrangementId = IntegrationTestData::getFilterAsInt("create_and_delete_song_comments", "song_arrangement_id");

        $notes = NoteRequest::forSongArrangement($songArrangementId)->get();
        foreach($notes as $note) {
            NoteRequest::forSongArrangement($songArrangementId)->delete($note->getIdAsInteger());
        }

        $notes = NoteRequest::forSongArrangement($songArrangementId)->get();
        $this->assertEmpty($notes);

        // Add one note
        $note = NoteRequest::forSongArrangement($songArrangementId)->create("Hello new comment!");
        $this->assertEquals("Hello new comment!", $note->getText());

        // Check if note is present
        $notes = NoteRequest::forSongArrangement($songArrangementId)->get();
        $this->assertEquals(1, sizeof($notes));
        $firstNote = end($notes);

        $this->assertEquals("Hello new comment!", $firstNote->getText());
    }

}
