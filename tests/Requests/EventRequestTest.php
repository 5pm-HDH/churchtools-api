<?php


use CTApi\Models\Event;
use CTApi\Requests\EventRequest;

class EventRequestTest extends TestCaseAuthenticated
{

    public function testGetAllEvents()
    {
        $allEvents = EventRequest::all();

        $this->assertTrue(sizeof($allEvents) > 0);
        $this->assertInstanceOf(Event::class, $allEvents[0]);
    }

    public function testGetWhereEvents()
    {
        $fromDate = "2021-01-01";
        $toDate = "2021-01-15";

        $events = EventRequest::where('from', $fromDate)
            ->where('to', $toDate)->get();

        $this->assertTrue(sizeof($events) > 0);
        $this->assertInstanceOf(Event::class, $events[0]);
    }

    // TODO further EventTests
}