<?php

namespace CTApi\Models\Calendars\CombinedAppointment;

class CombinedAppointmentRequest
{
    public static function forAppointment(int $calendarId, int $appointmentId, string $startDate): CombinedAppointmentRequestBuilder
    {
        return new CombinedAppointmentRequestBuilder($calendarId, $appointmentId, $startDate);
    }

}
