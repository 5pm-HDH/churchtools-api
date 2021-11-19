<?php

namespace Tests\Unit\Requests;

use CTApi\Requests\EventRequest;
use Tests\Unit\TestCaseHttpMocked;

class EventRequestUnitTest extends TestCaseHttpMocked
{

    public function testGetAllEvents(): void
    {
        $allEvents = EventRequest::all();

        $this->assertEquals(3, sizeof($allEvents));
    }

    public function testGetEvent(): void
    {
        $event = EventRequest::find(21);

        $this->assertNotNull($event);
        $this->assertEquals(21, $event->getId());
        $this->assertEquals("Sunday Service", $event->getName());
    }


}