<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Calendars\Appointment\Appointment;
use CTApi\Models\Calendars\Appointment\AppointmentRequest;
use CTApi\Models\Calendars\Calendar\CalendarRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

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

    public function testGetApppointments()
    {
        $allCalendars = CalendarRequest::all();
        $lastCalendar = end($allCalendars);

        $appointments = $lastCalendar->requestAppointments()
            ?->where("from", "2020-01-01")
            ?->where("to", "2022-01-01")
            ?->get() ?? [];
        $lastAppointment = end($appointments);

        $this->assertEquals(848, $lastAppointment->getId());
        $this->assertEquals("Service", $lastAppointment->getCaption());
        $this->assertEquals("2022-08-07T15:00:00Z", $lastAppointment->getStartDate());
        $this->assertEquals("2022-08-07T16:00:00Z", $lastAppointment->getEndDate());
        $this->assertEquals("2022-08-07 15:00:00", $lastAppointment->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("2022-08-07 16:00:00", $lastAppointment->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));

        $this->assertEquals("false", $lastAppointment->getAllDay());

        $this->assertEquals("Test Note", $lastAppointment->getNote());
        $this->assertEquals(1, $lastAppointment->getVersion());
        $this->assertEquals("Information Text", $lastAppointment->getInformation());
        $this->assertEquals("https://example.com", $lastAppointment->getLink());
        $this->assertEquals(false, $lastAppointment->getIsInternal());

        // Repeat of Appointment
        $this->assertEquals(0, $lastAppointment->getRepeatId());
        $this->assertEquals(1, $lastAppointment->getRepeatFrequency());

        // Retrieve Address:
        $this->assertEquals("Evangelische Brückengemeinde", $lastAppointment->getAddress()?->getMeetingAt());
        $this->assertEquals("Wilhelmstraße 132", $lastAppointment->getAddress()?->getStreet());
        $this->assertEquals("-", $lastAppointment->getAddress()?->getAddition());
        $this->assertEquals("-", $lastAppointment->getAddress()?->getDistrict());
        $this->assertEquals("89518", $lastAppointment->getAddress()?->getZip());
        $this->assertEquals("Heidenheim an der Brenz", $lastAppointment->getAddress()?->getCity());
        $this->assertEquals("DE", $lastAppointment->getAddress()?->getCountry());
        $this->assertEquals("48.680651", $lastAppointment->getAddress()?->getLatitude());
        $this->assertEquals("10.130883553439624", $lastAppointment->getAddress()?->getLongitude());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testGetAppointmentsViaBuilder()
    {
        $appointments = AppointmentRequest::forCalendar(21)->get();
        $appointments = AppointmentRequest::forCalendars([21, 22])
            ->where("from", "2020-02-01")
            ->where("to", "2022-02-01")->get();
    }


    public function testGetSeriesAppointments()
    {
        /**
         * Load Seminar series:
         * Consists of 2 series appointments
         * - #1: Friday 03.11.2023
         * - #2: Friday 10.11.2023
         */
        $appointments = $this->loadSeriesAppointments();

        $firstSeriesAppointment = $appointments[0];
        $secondSeriesAppointment = $appointments[1];

        /**
         * ID PROPERTY:
         * For every calculated series appointment the id stays the same as the base appointment:
         */
        $this->assertEquals(15, $firstSeriesAppointment->getId());
        $this->assertEquals(15, $firstSeriesAppointment->getId());

        /**
         * START_DATE / END_DATE PROPERTY:
         * Shows the start date / end date of the series appointment.
         */
        $this->assertEquals("2023-11-03T17:00:00Z", $firstSeriesAppointment->getStartDate());
        $this->assertEquals("2023-11-03T18:30:00Z", $firstSeriesAppointment->getEndDate());

        $this->assertEquals("2023-11-10T17:00:00Z", $secondSeriesAppointment->getStartDate());
        $this->assertEquals("2023-11-10T18:30:00Z", $secondSeriesAppointment->getEndDate());

        /**
         * BASE START_DATE / END_DATE PROPERTY:
         * Refers for every appointment to the base appointment, where the series starts:
         */
        $this->assertEquals("2023-11-03T17:00:00Z", $firstSeriesAppointment->getBaseStartDate());
        $this->assertEquals("2023-11-03T18:30:00Z", $firstSeriesAppointment->getBaseEndDate());

        $this->assertEquals("2023-11-03T17:00:00Z", $secondSeriesAppointment->getBaseStartDate());
        $this->assertEquals("2023-11-03T18:30:00Z", $secondSeriesAppointment->getBaseEndDate());

        /**
         * CALCULATED START_DATE / END_DATE PROPERTY:
         * Same as default startDate / endDate property. Contains the calculated date for the specific appointment.
         */
        $this->assertEquals("2023-11-03T17:00:00Z", $firstSeriesAppointment->getCalculatedStartDate());
        $this->assertEquals("2023-11-03T18:30:00Z", $firstSeriesAppointment->getCalculatedEndDate());

        $this->assertEquals("2023-11-10T17:00:00Z", $secondSeriesAppointment->getCalculatedStartDate());
        $this->assertEquals("2023-11-10T18:30:00Z", $secondSeriesAppointment->getCalculatedEndDate());

        /**
         * DATE_TIME:
         * All string properties can be casted to date time.
         */
        $firstSeriesAppointment->getStartDateAsDateTime();
        $firstSeriesAppointment->getBaseStartDateAsDateTime();
        $firstSeriesAppointment->getCalculatedStartDateAsDateTime();
        $firstSeriesAppointment->getEndDateAsDateTime();
        $firstSeriesAppointment->getBaseEndDateAsDateTime();
        $firstSeriesAppointment->getCalculatedEndDateAsDateTime();
    }

    /**
     * @return Appointment[]
     */
    private function loadSeriesAppointments(): array
    {
        $fileContent = file_get_contents(__DIR__ . '/calendar_request_series_appointments.json');
        $json = json_decode($fileContent, true);
        return Appointment::createModelsFromArray($json["data"]);
    }

}
