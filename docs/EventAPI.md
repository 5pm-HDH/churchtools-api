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
echo ($christmasService->getId());
// OUTPUT: 21
echo ($christmasService->getGuid());
// OUTPUT: guid21
echo ($christmasService->getName());
// OUTPUT: Sunday Service
echo ($christmasService->getDescription());
// OUTPUT: Service Description
echo ($christmasService->getStartDate());
// OUTPUT: 2021-09-02 20:15:00
echo ($christmasService->getEndDate());
// OUTPUT: 2021-09-02 22:00:00
echo ($christmasService->getChatStatus());
// OUTPUT: 
echo ($christmasService->getPermissions());
// OUTPUT: 
echo ($christmasService->getCalendar());
// OUTPUT: 
echo ($christmasService->getEventServices());
// OUTPUT: []


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

echo ($eventItemsList);
// OUTPUT: Opening Song (Song), First Worship Song (Song), Sermon (Default), 
echo ($eventSongsList);
// OUTPUT: We welcome you, 

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
echo ($songList);
// OUTPUT: We welcome you - In A-Dur (A - Dur) /


```

## Event-Services of Event

```php
use \CTApi\Requests\EventRequest;

$event = EventRequest::find(21);
$eventServices = $event->getEventServices();

$eventService = $eventServices[0];

echo ("SERVICE:");
// OUTPUT: SERVICE:
echo ($eventService->getId());
// OUTPUT: 221
echo ($eventService->getPersonId());
// OUTPUT: 21
echo ($eventService->getPerson()?->getLastName());
// OUTPUT: Smith
echo ($eventService->getName());
// OUTPUT: Worship-Leader
echo ($eventService->getServiceId());
// OUTPUT: 21
echo ($eventService->getAgreed());
// OUTPUT: 1
echo ($eventService->getIsValid());
// OUTPUT: 1
echo ($eventService->getRequestedDate());
// OUTPUT: 2001-01-02 02:02:12
echo ($eventService->getRequesterPersonId());
// OUTPUT: 21
echo ($eventService->getRequesterPerson()?->getLastName());
// OUTPUT: Smith
echo ($eventService->getComment());
// OUTPUT: No comment!
echo ($eventService->getCounter());
// OUTPUT: No counter!
echo ($eventService->getAllowChat());  
// OUTPUT: 1

$person = $eventService->requestPerson();
$requester = $eventService->requestRequesterPerson();

$service = $eventService->requestService();
echo ($service->getName());
// OUTPUT: Worship-Service


```