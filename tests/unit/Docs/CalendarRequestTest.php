<?php


namespace Tests\Unit\Docs;


use CTApi\Requests\CalendarRequest;
use Tests\Unit\TestCaseHttpMocked;

class CalendarRequestTest extends TestCaseHttpMocked
{

    public function testGetCalendars()
    {
        $allCalendars = CalendarRequest::all();
        $lastCalendar = end($allCalendars);

        $this->assertEquals(53, $lastCalendar->getId());
        $this->assertEquals("Sunday Service", $lastCalendar->getName());
        $this->assertEquals("Sunday Service", $lastCalendar->getNameTranslated());
        $this->assertEquals("#3e7000", $lastCalendar->getColor());
        $this->assertEquals(false, $lastCalendar->getIsPublic());
        $this->assertEquals(false, $lastCalendar->getIsPrivate());
        $this->assertEquals("ionastionasiono", $lastCalendar->getRandomUrl());
    }

}