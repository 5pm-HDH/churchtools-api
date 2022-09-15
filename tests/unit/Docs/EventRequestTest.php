<?php


namespace Tests\Unit\Docs;


use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;
use Tests\Unit\TestCaseHttpMocked;

class EventRequestTest extends TestCaseHttpMocked
{
    public function testEventRequestDocExample()
    {
        // Retrieve all events
        $allEvents = EventRequest::all();

        // Get specific Event
        $event = EventRequest::find(21);     // returns "null" if id is invalid
        $event = EventRequest::findOrFail(21); // throws exception if id is invalid

        // Filter events in period
        $christmasServices = EventRequest::where('from', '2020-12-24')
            ->where('to', '2020-12-26')
            ->orderBy('id')
            ->get();

        $christmasService = $christmasServices[0];

        /**
         * Event-Data
         */
        $this->assertEquals(21, $christmasService->getId());
        $this->assertEquals("guid21", $christmasService->getGuid());
        $this->assertEquals("Sunday Service", $christmasService->getName());
        $this->assertEquals("Service Description", $christmasService->getDescription());
        $this->assertEquals("2021-09-02 20:15:00", $christmasService->getStartDate());
        $this->assertEquals("2021-09-02 22:00:00", $christmasService->getEndDate());
        $this->assertEquals(false, $christmasService->getChatStatus());
        $this->assertEquals(null, $christmasService->getPermissions());
        $this->assertEquals(null, $christmasService->getCalendar());
        $this->assertEquals([], $christmasService->getEventServices());

        /**
         * Update Attachments -> see FileAPI
         */
        $files = $christmasService->requestFiles()?->get();
        //$newFile = $christmasService->requestFiles()?->upload("new-file.png");
    }

    public function testEventAgendaRequestDocExample()
    {
        $event = EventRequest::find(21);

        $agenda = EventAgendaRequest::fromEvent(21)->get();
        $agenda = $event?->requestAgenda();

        $eventItemsList = "";
        $eventSongsList = "";
        $agendaItems = ($agenda?->getItems() ?? []);
        foreach ($agendaItems as $item) {
            $eventItemsList .= $item->getTitle() . " (" . $item->getType() . "); ";
            $song = $item->getSong();
            if (!is_null($song)) {
                $eventSongsList .= $song->getName() . "; ";
            }
        }

        $this->assertEquals("Opening Song (Song); First Worship Song (Song); Sermon (Default); ", $eventItemsList);
        $this->assertEquals("We welcome you; ", $eventSongsList);

        $songs = $agenda?->requestSongs();
        $arrangements = $agenda?->requestArrangements();

        $songs = $agenda?->getSongs() ?? [];
        $songList = "";
        foreach ($songs as $song) {
            $selectedArrangement = $song->requestSelectedArrangement();
            $songList .= $song->getName() . " - "
                . $selectedArrangement->getName() . " ("
                . $selectedArrangement->getKeyOfArrangement() . " - Dur) /";
        }
        $this->assertEquals("We welcome you - In A-Dur (A - Dur) /", $songList);
    }

    public function testEventServicesRequestDocExample()
    {
        $event = EventRequest::find(21);
        $eventServices = $event?->getEventServices() ?? [];

        $eventService = $eventServices[0];

        // SERVICE:
        $this->assertEquals("221", $eventService?->getId());
        $this->assertEquals("21", $eventService?->getPersonId());
        $this->assertEquals("Smith", $eventService?->getPerson()?->getLastName());
        $this->assertEquals("Worship-Leader", $eventService?->getName());
        $this->assertEquals("21", $eventService?->getServiceId());
        $this->assertEquals(true, $eventService?->getAgreed());
        $this->assertEquals(true, $eventService?->getIsValid());
        $this->assertEquals("2001-01-02 02:02:12", $eventService?->getRequestedDate());
        $this->assertEquals("21", $eventService?->getRequesterPersonId());
        $this->assertEquals("Smith", $eventService?->getRequesterPerson()?->getLastName());
        $this->assertEquals("No comment!", $eventService?->getComment());
        $this->assertEquals("No counter!", $eventService?->getCounter());
        $this->assertEquals(true, $eventService?->getAllowChat());

        $person = $eventService?->requestPerson();
        $requester = $eventService?->requestRequesterPerson();

        $service = $eventService?->requestService();
        $this->assertEquals("Worship-Service", $service?->getName());
    }
}