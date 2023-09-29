# CalendarAPI

## Load all calendars:

```php
        use CTApi\Models\Calendars\Appointment\AppointmentRequest;
        use CTApi\Models\Calendars\Calendar\CalendarRequest;

        $allCalendars = CalendarRequest::all();
        $lastCalendar = end($allCalendars);

        var_dump( $lastCalendar->getId());
        // Output: 53

        var_dump( $lastCalendar->getName());
        // Output: "Sunday Service"

        var_dump( $lastCalendar->getNameTranslated());
        // Output: "Sunday Service"

        var_dump( $lastCalendar->getColor());
        // Output: "#3e7000"

        var_dump( $lastCalendar->getIsPublic());
        // Output: false

        var_dump( $lastCalendar->getIsPrivate());
        // Output: false

        var_dump( $lastCalendar->getRandomUrl());
        // Output: "ionastionasiono"


```

## Load appointments for calendar:

```php
        use CTApi\Models\Calendars\Appointment\AppointmentRequest;
        use CTApi\Models\Calendars\Calendar\CalendarRequest;

        $allCalendars = CalendarRequest::all();
        $lastCalendar = end($allCalendars);

        $appointments = $lastCalendar->requestAppointments()
                ?->where("from", "2020-01-01")
                ?->where("to", "2022-01-01")
                ?->get() ?? [];
        $lastAppointment = end($appointments);

        var_dump( $lastAppointment->getId());
        // Output: 848

        var_dump( $lastAppointment->getCaption());
        // Output: "Service"

        var_dump( $lastAppointment->getStartDate());
        // Output: "2022-08-07T15:00:00Z"

        var_dump( $lastAppointment->getEndDate());
        // Output: "2022-08-07T16:00:00Z"

        var_dump( $lastAppointment->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2022-08-07 15:00:00"

        var_dump( $lastAppointment->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
        // Output: "2022-08-07 16:00:00"


        var_dump( $lastAppointment->getAllDay());
        // Output: "false"


        var_dump( $lastAppointment->getNote());
        // Output: "Test Note"

        var_dump( $lastAppointment->getVersion());
        // Output: 1

        var_dump( $lastAppointment->getInformation());
        // Output: "Information Text"

        var_dump( $lastAppointment->getLink());
        // Output: "https://example.com"

        var_dump( $lastAppointment->getIsInternal());
        // Output: false


        // Repeat of Appointment
        var_dump( $lastAppointment->getRepeatId());
        // Output: 0

        var_dump( $lastAppointment->getRepeatFrequency());
        // Output: 1


        // Retrieve Address:
        var_dump( $lastAppointment->getAddress()?->getMeetingAt());
        // Output: "Evangelische Brückengemeinde"

        var_dump( $lastAppointment->getAddress()?->getStreet());
        // Output: "Wilhelmstraße 132"

        var_dump( $lastAppointment->getAddress()?->getAddition());
        // Output: "-"

        var_dump( $lastAppointment->getAddress()?->getDistrict());
        // Output: "-"

        var_dump( $lastAppointment->getAddress()?->getZip());
        // Output: "89518"

        var_dump( $lastAppointment->getAddress()?->getCity());
        // Output: "Heidenheim an der Brenz"

        var_dump( $lastAppointment->getAddress()?->getCountry());
        // Output: "DE"

        var_dump( $lastAppointment->getAddress()?->getLatitude());
        // Output: "48.680651"

        var_dump( $lastAppointment->getAddress()?->getLongitude());
        // Output: "10.130883553439624"


```

## Load appointments for multiple calendars:

```php
        use CTApi\Models\Calendars\Appointment\AppointmentRequest;
        use CTApi\Models\Calendars\Calendar\CalendarRequest;

        $appointments = AppointmentRequest::forCalendar(21)->get();
        $appointments = AppointmentRequest::forCalendars([21, 22])
            ->where("from", "2020-02-01")
            ->where("to", "2022-02-01")->get();

```

## Load appointment with event and bookings (CombinedAppointment):

Load single appointment including the event and bookings for this appointment.

**Parameters:**
- calendarId (in example: 2)
- appointmentId (in example: 13)
- startDate (in example: 2023-10-01)

```php
        use CTApi\Models\Calendars\CombinedAppointment\CombinedAppointmentRequest;

        $combinedAppointment = CombinedAppointmentRequest::forAppointment(2, 13, "2023-10-01")->get();

        $appointment = $combinedAppointment->getAppointment();
        var_dump( $appointment->getId());
        // Output: 13

        var_dump( $appointment->getCaption());
        // Output: "Gottesdienst - Erntedank"

        var_dump( $appointment->getInformation());
        // Output: "Erntedankgottesdienst."

        // see Appointment-Model

        $event = $combinedAppointment->getEvent();
        var_dump( $event->getId());
        // Output: 13

        var_dump( $event->getName());
        // Output: "Gottesdienst - Erntedank"

        var_dump( $event->getStartDate());
        // Output: "2023-10-01T09:00:00Z"

        // see Event-Model

        $bookings = $combinedAppointment->getBookings();
        $booking = end($bookings);
        var_dump( $booking->getId());
        // Output: 10

        var_dump( $booking->getCaption());
        // Output: "Gottesdienst - Erntedank"

        // see Booking-Model
        var_dump( $booking->getResource()?->getName());
        // Output: "Saal"

        // see Resource-Model

```