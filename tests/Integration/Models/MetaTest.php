<?php

namespace CTApi\Test\Integration\Models;

use CTApi\Exceptions\CTPermissionException;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Events\Event\EventAgendaRequest;
use CTApi\Models\Events\Song\SongRequest;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

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
        $eventId = IntegrationTestData::getFilter("get_event", "event_id");
        $agenda = EventAgendaRequest::fromEvent($eventId)->get();

        $this->assertModelHasValidMeta($agenda);

        $agendaItem = $agenda->getItems()[0];

        $this->assertNotNull($agendaItem);
        $this->assertModelHasValidMeta($agendaItem);
    }

    public function testSongMeta(): void
    {
        $allSongs = SongRequest::all();
        $this->assertNotEmpty($allSongs);

        $lastSong = end($allSongs);

        $this->assertModelHasValidMeta($lastSong);

        //test arrangement
        $arrangement = $lastSong->getArrangements()[0];
        $this->assertNotNull($arrangement);

        $this->assertModelHasValidMeta($arrangement);
    }

    private function assertModelHasValidMeta($model): void
    {
        $this->assertInstanceOf(Meta::class, $model->getMeta());

        //validate requestModifiedPerson and requestCreatedPerson
        try {
            $creator = $model->getMeta()->requestCreatedPerson();
            if (!is_null($creator)) {
                $this->assertInstanceOf(Person::class, $creator);
            }
        } catch (CTPermissionException $exception) {
            // ignore
        }

        try {
            $editor = $model->getMeta()->requestModifiedPerson();
            if (!is_null($editor)) {
                $this->assertInstanceOf(Person::class, $editor);
            }
        } catch (CTPermissionException $exception) {
            // ignore
        }
    }
}
