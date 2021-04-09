<?php


use CTApi\Models\EventAgenda;
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;

class EventAgendaTest extends TestCaseAuthenticated
{
    protected function setUp(): void
    {
        if (!TestData::getValue("EVENT_AGENDA_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
    }

    public function testGetAgenda()
    {
        $eventId = TestData::getValue("EVENT_AGENDA_EVENT_ID");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $this->assertAgendaIsValid($agenda);
        ModelValidator::validateModel($agenda);
    }

    public function testGetAgendaFromEvent()
    {
        $eventId = TestData::getValue("EVENT_AGENDA_EVENT_ID");

        $event = EventRequest::findOrFail($eventId);

        $agenda = $event->requestAgenda()->get();
        $this->assertAgendaIsValid($agenda);
    }

    private function assertAgendaIsValid($agenda)
    {
        $agendaId = TestData::getValue("EVENT_AGENDA_ID");
        $numberOfItems = TestData::getValue("EVENT_AGENDA_NUMBER_OF_ITEMS");


        $this->assertInstanceOf(EventAgenda::class, $agenda);
        $this->assertEquals($agendaId, $agenda->getId());
        $this->assertEquals($numberOfItems, sizeof($agenda->getItems()));
    }

    public function testGetSongsOfAgenda()
    {
        $eventId = TestData::getValue("EVENT_AGENDA_EVENT_ID");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $agendaItems = $agenda->getItems();

        $songArray = array_map(function ($agendaItem) {
            return $agendaItem->getSong();
        }, $agendaItems);

        $this->assertTestSongIsInSongArray($songArray);
    }

    public function testCollectSongsOfAgenda()
    {
        $eventId = TestData::getValue("EVENT_AGENDA_EVENT_ID");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();
        $songs = $agenda->getSongs();

        $this->assertTestSongIsInSongArray($songs);
    }

    private function assertTestSongIsInSongArray($songArray)
    {
        $foundSong = false;
        foreach ($songArray as $song) {
            if (is_null($song)) continue;
            if (
                $song->getName() == TestData::getValue("EVENT_AGENDA_SONG_NAME") &&
                $song->getArrangement() == TestData::getValue("EVENT_AGENDA_SONG_ARRANGEMENT")
            ) {
                $foundSong = true;
            }
        }
        $this->assertTrue($foundSong, "Could not find song in Agenda!");
    }

}