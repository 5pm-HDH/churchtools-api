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
        ModelValidator::validateModel($allEvents[0]);
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

    public function testOrderByEvents()
    {
        $eventOrderAscending = EventRequest::where('from', TestData::getValue("EVENT_START_DATE"))
            ->where('to', TestData::getValue("EVENT_END_DATE"))
            ->orderBy('startDate')
            ->get();

        $eventOrderDescending = EventRequest::where('from', TestData::getValue("EVENT_START_DATE"))
            ->where('to', TestData::getValue("EVENT_END_DATE"))
            ->orderBy('startDate', false)
            ->get();

        $eventOrderDescending2 = EventRequest::orderBy('startDate', false)
            ->where('from', TestData::getValue("EVENT_START_DATE"))
            ->where('to', TestData::getValue("EVENT_END_DATE"))
            ->get();

        $this->assertEquals(sizeof($eventOrderAscending), sizeof($eventOrderDescending));
        $this->assertEquals(sizeof($eventOrderAscending), sizeof($eventOrderDescending2));

        //create own startDate and sort it
        $startDateOfEvents = array_map(function ($record) {
            return $record->getStartDate();
        }, $eventOrderDescending);
        sort($startDateOfEvents);

        $this->assertEquals($startDateOfEvents[0], $eventOrderAscending[0]->getStartDate());
        $this->assertEquals(end($startDateOfEvents), $eventOrderDescending[0]->getStartDate());
        $this->assertEquals(end($startDateOfEvents), $eventOrderDescending2[0]->getStartDate());
    }
}