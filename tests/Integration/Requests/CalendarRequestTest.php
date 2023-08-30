<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;


class CalendarRequestTest extends TestCaseAuthenticated
{
    private ?string $calendarId = null;
    private ?string $calendarName = null;
    private ?string $appointmentFrom = null;
    private ?string $appointmentTo = null;
    private ?string $appointmentId = null;
    private ?string $appointmentCaption = null;
    private ?string $appointmentStartDate = null;
    private ?string $appointmentEndDate = null;

    protected function setUp(): void
    {
        $this->calendarId = IntegrationTestData::getFilter("filter_calendar", "calendar_id");
        $this->appointmentFrom = IntegrationTestData::getFilter("filter_calendar", "appointment_from");
        $this->appointmentTo = IntegrationTestData::getFilter("filter_calendar", "appointment_to");

        $this->calendarName = IntegrationTestData::getResult("filter_calendar", "calendar_name");
        $this->appointmentId = IntegrationTestData::getResult("filter_calendar", "any_appointment.id");
        $this->appointmentCaption = IntegrationTestData::getResult("filter_calendar", "any_appointment.caption");
        $this->appointmentStartDate = IntegrationTestData::getResult("filter_calendar", "any_appointment.start_date");
        $this->appointmentEndDate = IntegrationTestData::getResult("filter_calendar", "any_appointment.end_date");

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
        $this->assertEquals($this->appointmentStartDate, $foundAppointment->getStartDate());
        $this->assertEquals($this->appointmentEndDate, $foundAppointment->getEndDate());
    }
}