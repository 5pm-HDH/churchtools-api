<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\EventAgenda;
use CTApi\Utils\CTResponseUtil;

class EventAgendaRequestBuilder
{
    private int $eventId;

    public function __construct(int $eventId)
    {
        $this->eventId = $eventId;
    }

    public function get(): EventAgenda
    {
        $response = CTClient::getClient()->get('/api/events/' . $this->eventId . '/agenda');
        return EventAgenda::createModelFromData(CTResponseUtil::dataAsArray($response));
    }
}