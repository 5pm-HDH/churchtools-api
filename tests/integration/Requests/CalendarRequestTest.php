<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Requests\CalendarRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class CalendarRequestTest extends TestCaseAuthenticated
{
    private ?string $calendarId = null;
    private ?string $calendarName = null;

    protected function setUp(): void
    {
        if (!TestData::getValue("CALENDAR_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }else{
            $this->calendarId = TestData::getValue("CALENDAR_ID");
            $this->calendarName = TestData::getValue("CALENDAR_NAME");
        }
    }

    public function testGetAll()
    {
        $all = CalendarRequest::all();
        $this->assertNotEmpty($all);

        $foundSearchedCalendar = false;
        foreach($all as $calendar){
            if($calendar->getId() == $this->calendarId){
                $this->assertEquals($this->calendarName, $calendar->getName());
                $foundSearchedCalendar = true;
            }
        }
        $this->assertTrue($foundSearchedCalendar, "Could not find searched Calendar in Calendar-Request.");
    }
}