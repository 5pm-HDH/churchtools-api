# EventAPI

## Event-Request
```php
        use CTApi\Requests\EventAgendaRequest;
        use CTApi\Requests\EventRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        // Retrieve all events
        $allEvents = EventRequest::all();

        // Get specific Event
        $event = EventRequest::find(21);     // returns "null" if id is invalid
        $event = EventRequest::findOrFail(21); // throws exception if id is invalid

        // Filter events in period
        $christmasServices = EventRequest::where('from', '2020-12-24')
            ->where('to', '2020-12-26')
            ->orderBy('id')
            ->get();

        $christmasService = $christmasServices[0];

        /**
         * Event-Data
         */
        var_dump( $christmasService->getId());
        // Output: 21

        var_dump( $christmasService->getGuid());
        // Output: "guid21"

        var_dump( $christmasService->getName());
        // Output: "Sunday Service"

        var_dump( $christmasService->getDescription());
        // Output: "Service Description"

        var_dump( $christmasService->getStartDate());
        // Output: "2021-09-02 20:15:00"

        var_dump( $christmasService->getEndDate());
        // Output: "2021-09-02 22:00:00"

        var_dump( $christmasService->getChatStatus());
        // Output: false

        var_dump( $christmasService->getPermissions());
        // Output: null

        var_dump( $christmasService->getCalendar());
        // Output: null

        var_dump( $christmasService->getEventServices());
        // Output: []


        /**
         * Update Attachments -> see FileAPI
         */
        $files = $christmasService->requestFiles()?->get();
        //$newFile = $christmasService->requestFiles()?->upload("new-file.png");

```

## Event-Agenda

```php
        use CTApi\Requests\EventAgendaRequest;
        use CTApi\Requests\EventRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $event = EventRequest::find(21);

        $agenda = EventAgendaRequest::fromEvent(21)->get();
        $agenda = $event?->requestAgenda();

        $eventItemsList = "";
        $eventSongsList = "";
        $agendaItems = ($agenda?->getItems() ?? []);
        foreach ($agendaItems as $item) {
            $eventItemsList .= $item->getTitle() . " (" . $item->getType() . "); ";
            $song = $item->getSong();
            if (!is_null($song)) {
                $eventSongsList .= $song->getName() . "; ";
            }
        }

        var_dump( $eventItemsList);
        // Output: "Opening Song (Song); First Worship Song (Song); Sermon (Default); "

        var_dump( $eventSongsList);
        // Output: "We welcome you; "


        $songs = $agenda?->requestSongs();
        $arrangements = $agenda?->requestArrangements();

        $songs = $agenda?->getSongs() ?? [];
        $songList = "";
        foreach ($songs as $song) {
            $selectedArrangement = $song->requestSelectedArrangement();
            $songList .= $song->getName() . " - "
                . $selectedArrangement->getName() . " ("
                . $selectedArrangement->getKeyOfArrangement() . " - Dur) /";
        }
        var_dump( $songList);
        // Output: "We welcome you - In A-Dur (A - Dur) /"


```

## Event-Services of Event

```php
        use CTApi\Requests\EventAgendaRequest;
        use CTApi\Requests\EventRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;

        $event = EventRequest::find(21);
        $eventServices = $event?->getEventServices() ?? [];

        $eventService = $eventServices[0];

        // SERVICE:
        var_dump( $eventService?->getId());
        // Output: "221"

        var_dump( $eventService?->getPersonId());
        // Output: "21"

        var_dump( $eventService?->getPerson()?->getLastName());
        // Output: "Smith"

        var_dump( $eventService?->getName());
        // Output: "Worship-Leader"

        var_dump( $eventService?->getServiceId());
        // Output: "21"

        var_dump( $eventService?->getAgreed());
        // Output: true

        var_dump( $eventService?->getIsValid());
        // Output: true

        var_dump( $eventService?->getRequestedDate());
        // Output: "2001-01-02 02:02:12"

        var_dump( $eventService?->getRequesterPersonId());
        // Output: "21"

        var_dump( $eventService?->getRequesterPerson()?->getLastName());
        // Output: "Smith"

        var_dump( $eventService?->getComment());
        // Output: "No comment!"

        var_dump( $eventService?->getCounter());
        // Output: "No counter!"

        var_dump( $eventService?->getAllowChat());
        // Output: true


        $person = $eventService?->requestPerson();
        $requester = $eventService?->requestRequesterPerson();

        $service = $eventService?->requestService();
        var_dump( $service?->getName());
        // Output: "Worship-Service"


```