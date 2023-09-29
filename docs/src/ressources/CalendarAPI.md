# CalendarAPI

## Load all calendars:

{{ \CTApi\Test\Unit\Docs\CalendarRequestTest.testGetCalendars }}

## Load appointments for calendar:

{{ \CTApi\Test\Unit\Docs\CalendarRequestTest.testGetApppointments }}

## Load appointments for multiple calendars:

{{ \CTApi\Test\Unit\Docs\CalendarRequestTest.testGetAppointmentsViaBuilder }}

## Load appointment with event and bookings (CombinedAppointment):

Load single appointment including the event and bookings for this appointment.

**Parameters:**
- calendarId (in example: 2)
- appointmentId (in example: 13)
- startDate (in example: 2023-10-01)

{{ \CTApi\Test\Unit\Docs\CombinedAppointmentRequestTest.testCombinedAppointment }}