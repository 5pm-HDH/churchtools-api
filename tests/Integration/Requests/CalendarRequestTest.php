<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\CTLog;
use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;
use CTApi\Models\Calendars\CombinedAppointment\CombinedAppointmentRequest;
use CTApi\Models\Common\File\File;
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

    public function testCombinedAppointmentRequest()
    {
        $testCase = IntegrationTestData::getTestCase("combined_appointment");

        $calendarId = $testCase->getFilter("calendar_id");
        $appointmentId = $testCase->getFilter("appointment_id");
        $startDate = $testCase->getFilter("start_date");

        $combinedAppointment = CombinedAppointmentRequest::forAppointment($calendarId, $appointmentId, $startDate)->get();

        $appointment = $combinedAppointment->getAppointment();
        $this->assertEqualsTestData("combined_appointment", "appointment.caption", $appointment->getCaption());
        $this->assertEqualsTestData("combined_appointment", "appointment.information", $appointment->getInformation());
        $this->assertInstanceOf(File::class, $appointment->getImage());
        $this->assertEqualsTestData("combined_appointment", "appointment.image.id", $appointment->getImage()->getId());
        $this->assertEqualsTestData("combined_appointment", "appointment.image.name", $appointment->getImage()->getName());


        $event = $combinedAppointment->getEvent();
        $this->assertEqualsTestData("combined_appointment", "event.id", $event->getId());
        $this->assertEqualsTestData("combined_appointment", "event.name", $event->getName());
        $this->assertEqualsTestData("combined_appointment", "event.startDate", $event->getStartDate());

        $bookings = $combinedAppointment->getBookings();
        $oneBooking = end($bookings);
        $this->assertEqualsTestData("combined_appointment", "any_booking.id", $oneBooking->getId());
        $this->assertEqualsTestData("combined_appointment", "any_booking.resource.id", $oneBooking->getResource()?->getId());
        $this->assertEqualsTestData("combined_appointment", "any_booking.resource.name", $oneBooking->getResource()?->getName());
    }

    public function testSeriesAppointment()
    {
        $testCase = IntegrationTestData::getTestCase("appointment_series");

        $calendar_id = $testCase->getFilterAsInt("calendar_id");
        $from = $testCase->getFilter("from");
        $to = $testCase->getFilter("to");

        $appointments = AppointmentRequest::forCalendar($calendar_id)
            ->where("from", $from)
            ->where("to", $to)->get();

        $this->assertTrue(sizeof($appointments) >= 2);

        $firstSeriesAppointment = null;
        $first_startDate = $testCase->getResult("first_series_appointment.calculated_start_date");
        $secondSeriesAppointment = null;
        $second_startDate = $testCase->getResult("second_series_appointment.calculated_start_date");

        foreach($appointments as $appointment) {
            if($first_startDate === $appointment->getStartDate()) {
                $firstSeriesAppointment = $appointment;
            }
            if($second_startDate === $appointment->getStartDate()) {
                $secondSeriesAppointment = $appointment;
            }
        }

        $this->assertNotNull($firstSeriesAppointment);
        $this->assertEquals($testCase->getResult("first_series_appointment.base_start_date"), $firstSeriesAppointment->getBaseStartDate());

        $this->assertNotNull($secondSeriesAppointment);
        $this->assertEquals($testCase->getResult("second_series_appointment.base_start_date"), $secondSeriesAppointment->getBaseStartDate());
    }
}
