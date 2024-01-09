<?php

namespace CTApi\Models\Events\Event;

class EventAgendaRequest
{
    public static function fromEvent(int $eventId): EventAgendaRequestBuilder
    {
        return (new EventAgendaRequestBuilder($eventId));
    }
}
