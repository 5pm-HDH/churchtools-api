<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Calendars\CombinedAppointment\CombinedAppointmentRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class CombinedAppointmentRequestTest extends TestCaseHttpMocked
{
    public function testCombinedAppointment()
    {
        $combinedAppointment = CombinedAppointmentRequest::forAppointment(2, 13, "2023-10-01")->get();

        $appointment = $combinedAppointment->getAppointment();
        $this->assertEquals(13, $appointment->getId());
        $this->assertEquals("Gottesdienst - Erntedank", $appointment->getCaption());
        $this->assertEquals("Erntedankgottesdienst.", $appointment->getInformation());
        // see Appointment-Model

        $event = $combinedAppointment->getEvent();
        $this->assertEquals(13, $event->getId());
        $this->assertEquals("Gottesdienst - Erntedank", $event->getName());
        $this->assertEquals("2023-10-01T09:00:00Z", $event->getStartDate());
        // see Event-Model

        $bookings = $combinedAppointment->getBookings();
        $booking = end($bookings);
        $this->assertEquals(10, $booking->getId());
        $this->assertEquals("Gottesdienst - Erntedank", $booking->getCaption());
        // see Booking-Model
        $this->assertEquals("Saal", $booking->getResource()?->getName());
        // see Resource-Model
    }

}
