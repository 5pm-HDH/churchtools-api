# CalendarAPI

Load all calendars:

```php
        use CTApi\Requests\AppointmentRequest;
        use CTApi\Requests\CalendarRequest;

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

Load appointments for calendar:

```php
        use CTApi\Requests\AppointmentRequest;
        use CTApi\Requests\CalendarRequest;

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


```

Load appointments for multiple calendars:

```php
        use CTApi\Requests\AppointmentRequest;
        use CTApi\Requests\CalendarRequest;

        $appointments = AppointmentRequest::forCalendar(21)->get();
        $appointments = AppointmentRequest::forCalendars([21, 22])
            ->where("from", "2020-02-01")
            ->where("to", "2022-02-01")->get();

```
