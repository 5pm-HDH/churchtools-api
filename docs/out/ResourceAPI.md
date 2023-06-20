# Resource and Bookings API

Load all Resources that are stored in ChurchTools.

```php
        use CTApi\Requests\ResourceBookingsRequest;
        use CTApi\Requests\ResourceRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $allResources = ResourceRequest::all();
        $firstResource = $allResources[0];

        var_dump( $firstResource->getId());
        // Output: "21"

        var_dump( $firstResource->getName());
        // Output: "Worship Room"

        var_dump( $firstResource->getResourceType()?->getName());
        // Output: "Rooms"


```

Load bookings for specific resource:

```php
        use CTApi\Requests\ResourceBookingsRequest;
        use CTApi\Requests\ResourceRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $allResources = ResourceRequest::all();
        $firstResource = $allResources[0];

        $bookings = $firstResource->requestBookings()
            ?->where("from", "2021-02-22")
            ->where("to", "2021-02-26")
            ->get();

        $firstBooking = $bookings[0];

        var_dump( $firstBooking->getId());
        // Output: "221"

        var_dump( $firstBooking->getCaption());
        // Output: "Sunday Service"

        var_dump( $firstBooking->getVersion());
        // Output: "8"

        var_dump( $firstBooking->requestPerson()?->getFirstName());
        // Output: "Matthew"

        var_dump( $firstBooking->getStartDate());
        // Output: "2021-02-24T06:00:00Z"

        var_dump( $firstBooking->getStatusId());
        // Output: "2"


        // Status-IDs (see: https://intern.church.tools/api)
        // 1 - Wartet auf Bestätigung
        // 2 - Bestätigt
        // 3 - Abgelehnt
        // 99 - Gelöscht

```

Load bookings for multiple resoures:

```php
        use CTApi\Requests\ResourceBookingsRequest;
        use CTApi\Requests\ResourceRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $bookings = ResourceBookingsRequest::forResources([21, 22, 23])
            ->where("from", "2021-02-22")
            ->where("status_ids", [2]) // only loads bookings with status id = 2 (Bestätigt)
            ->get();

        $firstBooking = $bookings[0];

        var_dump( $firstBooking->getId());
        // Output: "221"


```
