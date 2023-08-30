<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Events\Event\Event;
use CTApi\Models\Events\Event\EventAgenda;
use CTApi\Test\Unit\TestCaseHttpMocked;

class ModelEventTest extends TestCaseHttpMocked
{

    public function testRequestMethod()
    {
        $event = Event::createModelFromData(['id' => 21]);
        $agenda = $event->requestAgenda();

        $this->assertEquals("Sunday Service Agenda", $agenda->getName());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testRequestMethodPlural()
    {
        $eventAgenda = EventAgenda::createModelFromData(['id' => 21]);

        $songs = $eventAgenda->requestSongs()
            ->where('practice', true)
            ->orderBy('key')
            ->get();
    }
}