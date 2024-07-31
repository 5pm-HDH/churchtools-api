<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Common\Note\NoteRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class NoteRequestTest extends TestCaseHttpMocked
{
    public function testRequestNotes()
    {
        $notes = NoteRequest::forGroup(212)->get();
        $this->assertEquals("Hello new comment!", $notes[0]->getText());
        $this->assertEquals("17", $notes[0]->getDomainId());
        $this->assertEquals("group", $notes[0]->getDomainType());
        $this->assertEquals("212", $notes[0]->getId());
    }

    public function testCreateNote()
    {
        $note = NoteRequest::forGroup(52)->create("Add new comment.");
        $this->assertEquals("Add new comment.", $note->getText());
    }

    public function testUpdateNote()
    {
        $note = NoteRequest::forGroup(52)->update(25, "Updated comment.");
        $this->assertEquals("Updated comment.", $note->getText());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDeleteNote()
    {
        NoteRequest::forGroup(52)->delete(25);
    }

    public function testUpdateSongArrangementNotes()
    {
        $notes = NoteRequest::forSongArrangement(21)->get();

        $this->assertEquals("Hello new comment!", $notes[0]->getText());
        $this->assertEquals("17", $notes[0]->getDomainId());
        $this->assertEquals("group", $notes[0]->getDomainType());
        $this->assertEquals("212", $notes[0]->getId());

        $securityLevelId = 2;
        $note = NoteRequest::forSongArrangement(21)->create("New comment", $securityLevelId);
        $note = NoteRequest::forSongArrangement(21)->update(2, "New comment");

        NoteRequest::forSongArrangement(21)->delete(2);
    }
}
