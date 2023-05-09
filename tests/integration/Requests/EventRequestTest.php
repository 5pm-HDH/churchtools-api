<?php

namespace Tests\Integration\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Models\DomainAttributeModel;
use CTApi\Models\Event;
use CTApi\Models\Person;
use CTApi\Models\Service;
use CTApi\Requests\EventRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class EventRequestTest extends TestCaseAuthenticated
{

    public function testGetAllEvents(): void
    {
        $allEvents = EventRequest::all();

        if (sizeof($allEvents) > 0) {
            $this->assertInstanceOf(Event::class, $allEvents[0]);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testGetWhereEvents(): void
    {
        $testCase = IntegrationTestData::getTestCase("filter_events");

        $fromDate = $testCase->getFilter("start_date");
        $toDate = $testCase->getFilter("end_date");

        $events = EventRequest::where('from', $fromDate)
            ->where('to', $toDate)->get();

        $this->assertEquals(sizeof($events), $testCase->getResult("number_of_elements"));
        $this->assertInstanceOf(Event::class, $events[0]);

        $this->assertEquals($testCase->getResult("first_element.id"), $events[0]->getId());
        $this->assertEquals($testCase->getResult("first_element.name"), $events[0]->getName());
    }

    public function testFindOrFail(): void
    {
        $testCase = IntegrationTestData::getTestCase("get_event");
        $eventId = $testCase->getFilter("event_id");

        $event = EventRequest::find($eventId);
        $eventTwo = EventRequest::findOrFail($eventId);

        $this->assertNotNull($event);
        $this->assertInstanceOf(DomainAttributeModel::class, $event->getCalendar());

        $this->assertEquals($event, $eventTwo);
        $this->assertEquals($testCase->getResult("name"), $eventTwo->getName());

        $this->expectException(CTRequestException::class);
        EventRequest::findOrFail(99999999);
    }

    public function testOrderByEvents(): void
    {
        $testCase = IntegrationTestData::getTestCase("filter_events");

        $eventOrderAscending = EventRequest::where('from', $testCase->getFilter("start_date"))
            ->where('to', $testCase->getFilter("end_date"))
            ->orderBy('startDate')
            ->get();

        $eventOrderDescending = EventRequest::where('from', $testCase->getFilter("start_date"))
            ->where('to', $testCase->getFilter("end_date"))
            ->orderBy('startDate', false)
            ->get();

        $eventOrderDescending2 = EventRequest::orderBy('startDate', false)
            ->where('from', $testCase->getFilter("start_date"))
            ->where('to', $testCase->getFilter("end_date"))
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

    public function testEventServiceGroups(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event", "event_id");

        $event = EventRequest::find($eventId);

        $this->assertNotNull($event);
        $eventServices = $event->getEventServices();
        $this->assertNotNull($eventServices);
        $eventService = $eventServices[0];

        if (!is_null($eventService->getPerson())) {
            $this->assertInstanceOf(Person::class, $eventService->getPerson());
        }
        if (!is_null($eventService->requestPerson())) {
            $this->assertInstanceOf(Person::class, $eventService->requestPerson());
        }
        if (!is_null($eventService->getRequesterPerson())) {
            $this->assertInstanceOf(Person::class, $eventService->getRequesterPerson());
        }
        if (!is_null($eventService->requestRequesterPerson())) {
            $this->assertInstanceOf(Person::class, $eventService->requestRequesterPerson());
        }
        $serviceOfEventService = $eventService->requestService();
        if (!is_null($serviceOfEventService)) {
            $this->assertInstanceOf(Service::class, $serviceOfEventService);
            $this->assertEquals($serviceOfEventService->getId(), $eventService->getServiceId());
        }
    }

    public function testRequestEventServiceWithServiceId(): void
    {
        $eventId = IntegrationTestData::getFilter("get_event", "event_id");

        $event = EventRequest::find($eventId);

        $this->assertNotNull($event);
        $eventService = $event->requestEventServiceWithServiceId(92814821428);
        $this->assertNull($eventService);
    }
}