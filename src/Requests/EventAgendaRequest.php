<?php


namespace CTApi\Requests;


class EventAgendaRequest
{
    public static function fromEvent(int $eventId): EventAgendaRequestBuilder
    {
        return (new EventAgendaRequestBuilder($eventId));
    }
}