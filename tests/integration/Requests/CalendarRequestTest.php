<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Requests\AppointmentRequest;
use CTApi\Requests\CalendarRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class CalendarRequestTest extends TestCaseAuthenticated
{
    private ?string $calendarId = null;
    private ?string $calendarName = null;
    private ?string $appointmentFrom = null;
    private ?string $appointmentTo = null;
    private ?string $appointmentId = null;
    private ?string $appointmentCaption = null;

    protected function setUp(): void
    {
        if (!TestData::getValue("CALENDAR_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->calendarId = TestData::getValue("CALENDAR_ID");
            $this->calendarName = TestData::getValue("CALENDAR_NAME");
            $this->appointmentFrom = TestData::getValue("APPOINTMENT_FROM");
            $this->appointmentTo = TestData::getValue("APPOINTMENT_TO");
            $this->appointmentId = TestData::getValue("APPOINTMENT_ID");
            $this->appointmentCaption = TestData::getValue("APPOINTMENT_CAPTION");
        }
    }

    public function testGetAll()
    {
        $all = CalendarRequest::all();
        $this->assertNotEmpty($all);

        $foundSearchedCalendar = false;
        foreach ($all as $calendar) {
            if ($calendar->getId() == $this->calendarId) {
                $this->assertEquals($this->calendarName, $calendar->getName());
                $foundSearchedCalendar = true;
            }
        }
        $this->assertTrue($foundSearchedCalendar, "Could not find searched Calendar in Calendar-Request.");
    }

    public function testGetAppointments()
    {
        $allAppointments = AppointmentRequest::forCalendar((int)$this->calendarId)
            ->where("from", $this->appointmentFrom)
            ->where("to", $this->appointmentTo)->get();

        $this->assertNotEmpty($allAppointments);
        $foundAppointment = null;
        foreach ($allAppointments as $appointment) {
            if ($appointment->getId() == $this->appointmentId) {
                $foundAppointment = $appointment;
            }
        }
        $this->assertNotNull($foundAppointment);
        $this->assertEquals($this->appointmentCaption, $foundAppointment->getCaption());
    }
}