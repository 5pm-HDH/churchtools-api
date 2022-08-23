# CalendarAPI

Load all calendars:

```php
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
