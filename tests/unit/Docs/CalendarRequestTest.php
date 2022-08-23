<?php


namespace Tests\Unit\Docs;


use CTApi\Requests\AppointmentRequest;
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