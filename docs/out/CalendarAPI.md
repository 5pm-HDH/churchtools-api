# CalendarAPI

Load all calendars:

```php
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

Load appointments for calendar:

```php
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

Load appointments for multiple calendars:

```php
        use CTApi\Models\Calendars\Appointment\AppointmentRequest;

        $appointments = AppointmentRequest::forCalendar(21)->get();
        $appointments = AppointmentRequest::forCalendars([21, 22])
            ->where("from", "2020-02-01")
            ->where("to", "2022-02-01")->get();

```
