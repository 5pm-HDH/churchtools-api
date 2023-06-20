<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Requests\AppointmentRequest;
use CTApi\Requests\CalendarRequest;
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

}