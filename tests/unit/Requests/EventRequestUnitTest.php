<?php

namespace Tests\Unit\Requests;

use CTApi\Requests\EventRequest;
use Tests\Unit\TestCaseHttpMocked;

class EventRequestUnitTest extends TestCaseHttpMocked
{

    public function testGetAllEvents()
    {
        $allEvents = EventRequest::all();

        $this->assertIsArray($allEvents);
        $this->assertEquals(3, sizeof($allEvents));
    }

    public function testGetEvent()
    {
        $event = EventRequest::find(21);

        $this->assertNotNull($event);
        $this->assertEquals(21, $event->getId());
        $this->assertEquals("Sunday Service", $event->getName());
    }


}