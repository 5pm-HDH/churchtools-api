<?php

namespace Tests\Integration\Models;

use CTApi\Models\Meta;
use CTApi\Models\Person;
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\PersonRequest;
use CTApi\Requests\SongRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class MetaTest extends TestCaseAuthenticated
{
    public function testPersonMeta(): void
    {
        $person = PersonRequest::whoami();
        $this->assertModelHasValidMeta($person);
    }

    //Event has no Meta-Data

    public function testEventAgendaMeta(): void
    {
        $this->checkIfTestShouldBeSkipped("EVENT_AGENDA_SHOULD_TEST");

        $eventId = (int)TestData::getValue("EVENT_AGENDA_EVENT_ID");
        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $this->assertModelHasValidMeta($agenda);

        $agendaItem = $agenda->getItems()[0];

        $this->assertNotNull($agendaItem);
        $this->assertModelHasValidMeta($agendaItem);
    }

    public function testSongMeta(): void
    {
        $this->checkIfTestShouldBeSkipped("SONG_SHOULD_TEST");

        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $lastSong = end($allSongs);

        $this->assertModelHasValidMeta($lastSong);

        //test arrangement
        $arrangement = $lastSong->getArrangements()[0];
        $this->assertNotNull($arrangement);

        $this->assertModelHasValidMeta($arrangement);
    }

    private function checkIfTestShouldBeSkipped($testIniKey): void
    {
        if (!TestData::getValue($testIniKey) == "YES") {
            $this->markTestSkipped("Test is disabled in testdata.ini");
        }
    }

    private function assertModelHasValidMeta($model): void
    {
        $this->assertInstanceOf(Meta::class, $model->getMeta());

        //validate requestModifiedPerson and requestCreatedPerson
        $creator = $model->getMeta()->requestCreatedPerson();
        if (!is_null($creator)) {
            $this->assertInstanceOf(Person::class, $creator);
        }

        $editor = $model->getMeta()->requestModifiedPerson();
        if (!is_null($editor)) {
            $this->assertInstanceOf(Person::class, $editor);
        }
    }
}