# EventAPI

## Event-Request
```php
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;

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
dd($christmasService->getId());
dd($christmasService->getGuid());
dd($christmasService->getName());
dd($christmasService->getDescription());
dd($christmasService->getStartDate());
dd($christmasService->getEndDate());
dd($christmasService->getChatStatus());
dd($christmasService->getPermissions());
dd($christmasService->getCalendar());
dd($christmasService->getEventServices());

```

## Event-Agenda

```php
use CTApi\Requests\EventRequest;
use CTApi\Requests\EventAgendaRequest;

$event = EventRequest::find(21);

$agenda = EventAgendaRequest::fromEvent(21)->get();
$agenda = $event->requestAgenda();

$eventItemsList = "";
$eventSongsList = "";
foreach($agenda->getItems() as $item){
    $eventItemsList .= $item->getTitle() . " (".$item->getType()."), ";
    $song = $item->getSong();
    if(!is_null($song)){
        $eventSongsList.= $song->getName() . ", ";
    }
}

dd($eventItemsList);
dd($eventSongsList);

$songs = $agenda->requestSongs();
$arrangements = $agenda->requestArrangements();

$songs = $agenda->getSongs();
$songList = "";
foreach($songs as $song){
    $selectedArrangement = $song->requestSelectedArrangement();
    $songList .= $song->getName()." - "
        .$selectedArrangement->getName()." ("
        .$selectedArrangement->getKeyOfArrangement()." - Dur) /";
}
dd($songList);

```

## Event-Services of Event

```php
use \CTApi\Requests\EventRequest;

$event = EventRequest::find(21);
$eventServices = $event->getEventServices();

$eventService = $eventServices[0];

dd("SERVICE:");
dd($eventService->getId());
dd($eventService->getPersonId());
dd($eventService->getPerson()?->getLastName());
dd($eventService->getName());
dd($eventService->getServiceId());
dd($eventService->getAgreed());
dd($eventService->getIsValid());
dd($eventService->getRequestedDate());
dd($eventService->getRequesterPersonId());
dd($eventService->getRequesterPerson()?->getLastName());
dd($eventService->getComment());
dd($eventService->getCounter());
dd($eventService->getAllowChat());  

$person = $eventService->requestPerson();
$requester = $eventService->requestRequesterPerson();

$service = $eventService->requestService();
dd($service->getName());

```