# EventAPI

```php
use CTApi\Requests\EventAgendaRequest;
use CTApi\Requests\EventRequest;

/**
 * Event-Request
 */
 
// Retrieve all events
$allEvents = EventRequest::all();

// Get specific Event
$event = EventRequest::find(21);     // returns "null" if id is invalid
$event = EventRequest::findOrFail(22); // throws exception if id is invalid

// Filter events in period
$christmasServices = EventRequest::where('from', '2020-12-24')
                    ->where('to', '2020-12-26')
                    ->orderBy('id')
                    ->get();
  
$christmasService = $christmasServices[0];

/**
 * Event-Data
 */
echo "-".$christmasService->getId();
echo "-".$christmasService->getGuid();
echo "-".$christmasService->getName();
echo "-".$christmasService->getDescription();
echo "-".$christmasService->getStartDate();
echo "-".$christmasService->getEndDate();
echo "-".$christmasService->getChatStatus();
print_r($christmasService->getPermissions());
print_r($christmasService->getCalendar());
print_r($christmasService->getEventServices());

  
/**
 * Event-Agenda 
 */

$event = EventRequest::find(21);

$agenda = EventAgendaRequest::fromEvent(21)->get();
$agenda = $event->requestAgenda();

foreach($agenda->getItems() as $item){
    echo "<li>".$item->getTitle()." (".$item->getType().")</li>";

    $song = $item->getSong();
    if(!is_null($song)){
        echo "> Song:".$song->getName();
    }
}

$songs = $agenda->requestSongs();
$arrangements = $agenda->requestArrangements();

$songs = $agenda->getSongs();
foreach($songs as $song){
    $selectedArrangement = $song->requestSelectedArrangements();
    echo "<li>"
        .$song->getName()." - "
        .$selectedArrangement->getName()." ("
        .$selectedArrangement->getKey()." - Dur)</li>";
}

/**
 * EventService of Event
 */
$eventServices = $event->getEventServices();

foreach($eventServices as $eventService){
    echo "SERVICE:";
    echo "-".$eventService->getId();
    echo "-".$eventService->getPersonId();
    echo "-".$eventService->getPerson()?->getLastName();
    echo "-".$eventService->getName();
    echo "-".$eventService->getServiceId();
    echo "-".$eventService->getAgreed();
    echo "-".$eventService->getIsValid();
    echo "-".$eventService->getRequestedDate();
    echo "-".$eventService->getRequesterPersonId();
    echo "-".$eventService->getRequesterPerson()?->getLastName();
    echo "-".$eventService->getComment();
    echo "-".$eventService->getCounter();
    echo "-".$eventService->getAllowChat();  
    
    $person = $eventService->requestPerson();
    $requester = $eventService->requestRequesterPerson();
    
    $service = $eventServices->requestService();
    echo "SERVICE: ".$service->getName();
}
```