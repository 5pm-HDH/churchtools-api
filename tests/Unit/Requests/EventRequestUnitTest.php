<?php

namespace CTApi\Test\Unit\Requests;

use CTApi\Models\Events\Event\EventRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class EventRequestUnitTest extends TestCaseHttpMocked
{
    public function testGetAllEvents(): void
    {
        $allEvents = EventRequest::all();

        $this->assertEquals(8, sizeof($allEvents));
    }

    public function testGetEvent(): void
    {
        $event = EventRequest::find(21);

        $this->assertNotNull($event);
        $this->assertEquals(21, $event->getId());
        $this->assertEquals("Sunday Service", $event->getName());
    }


}
