<?php

namespace Tests\Integration\Requests;

use CTApi\Models\EventAgenda;
use CTApi\Models\Song;
use CTApi\Models\SongArrangement;
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class EventAgendaTest extends TestCaseAuthenticated
{

    public function testGetAgenda(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $this->assertAgendaIsValid($agenda);
    }

    public function testGetAgendaFromEvent(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");

        $event = EventRequest::findOrFail($eventId);

        $agenda = $event->requestAgenda();
        $this->assertAgendaIsValid($agenda);
    }

    private function assertAgendaIsValid($agenda): void
    {
        $agendaId = IntegrationTestData::getResult("get_event_agenda", "agenda_id");
        $numberOfItems = IntegrationTestData::getResult("get_event_agenda", "nr_of_agenda_items");

        $this->assertInstanceOf(EventAgenda::class, $agenda);
        $this->assertEquals($agendaId, $agenda->getId());
        $this->assertEquals($numberOfItems, sizeof($agenda->getItems()));
    }

    public function testGetSongsOfAgenda(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $agendaItems = $agenda->getItems();

        $songArray = array_map(function ($agendaItem) {
            return $agendaItem->getSong();
        }, $agendaItems);

        $this->assertTestSongIsInSongArray($songArray);
    }

    public function testCollectSongsOfAgenda(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();
        $songs = $agenda->getSongs();

        $this->assertTestSongIsInSongArray($songs);
    }

    public function testRequestSongsOfAgenda(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");

        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $songs = $agenda->requestSongs()->get();

        $this->assertTestSongIsInSongArray($songs, false);
    }

    public function testRequestSelectedArrangementOfSong(): void
    {
        $songId = IntegrationTestData::getFilter("get_event_agenda", "selected_song_id");
        $arrangementId = IntegrationTestData::getFilter("get_event_agenda", "selected_song_arrangement_id");

        $song = new Song();

        $this->assertNull($song->requestSelectedArrangement());
        $song->setId($songId);

        $this->assertNull($song->requestSelectedArrangement());
        $song->setArrangementId($arrangementId);

        $arrangement = $song->requestSelectedArrangement();

        $this->assertNotNull($arrangement);
        $this->assertEquals($arrangementId, $arrangement->getId());
        $this->assertEquals(IntegrationTestData::getResult("get_event_agenda", "selected_song_arrangement_name"), $arrangement->getName());
    }

    public function testRequestArrangementsOfAgenda(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event_agenda", "event_id");
        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $arrangements = $agenda->requestArrangements()->get();

        foreach ($arrangements as $arrangement) {
            $this->assertInstanceOf(SongArrangement::class, $arrangement);
        }
    }

    private function assertTestSongIsInSongArray($songArray, $checkForArrangement = true): void
    {
        $foundSong = false;
        foreach ($songArray as $song) {
            if (is_null($song)) {
                continue;
            }
            if (
                $song->getName() == IntegrationTestData::getResult("get_event_agenda", "selected_song_name")
            ) {

                if ($checkForArrangement) {
                    if ($song->getArrangement() == IntegrationTestData::getResult("get_event_agenda", "selected_song_arrangement_name")) {
                        $foundSong = true;
                    } else {
                        $foundSong = false;
                    }
                } else {
                    $foundSong = true;
                }

            }
        }
        $this->assertTrue($foundSong, "Could not find song in Agenda!");
    }

}
