<?php


use CTApi\Exceptions\CTModelException;
use CTApi\Models\Event;
use CTApi\Requests\EventRequest;

class EventRequestTest extends TestCaseAuthenticated
{

    protected function setUp(): void
    {
        if (!TestData::getValue("EVENT_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
    }


    public function testGetAllEvents()
    {
        $allEvents = EventRequest::all();

        $this->assertFalse(empty(sizeof($allEvents)));
        $this->assertInstanceOf(Event::class, $allEvents[0]);
    }

    public function testGetWhereEvents()
    {
        $fromDate = TestData::getValue("EVENT_START_DATE");
        $toDate = TestData::getValue("EVENT_END_DATE");

        $events = EventRequest::where('from', $fromDate)
            ->where('to', $toDate)->get();

        $this->assertEquals(sizeof($events), TestData::getValue("EVENT_NUMBERS"));
        $this->assertInstanceOf(Event::class, $events[0]);

        $this->assertEquals(TestData::getValue("EVENT_FIRST_ID"), $events[0]->getId());
        $this->assertEquals(TestData::getValue("EVENT_FIRST_NAME"), $events[0]->getName());
    }

    public function testFindOrFail()
    {
        $eventId = TestData::getValue("EVENT_FIRST_ID");

        $event = EventRequest::find($eventId);
        $eventTwo = EventRequest::findOrFail($eventId);

        $this->assertEquals($event, $eventTwo);
        $this->assertEquals(TestData::getValue("EVENT_FIRST_NAME"), $eventTwo->getName());

        $this->expectException(CTModelException::class);
        EventRequest::findOrFail(99999999);
    }
}