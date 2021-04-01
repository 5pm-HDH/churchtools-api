<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\EventAgenda;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class EventAgendaRequestBuilder
{
    private int $eventId;

    public function __construct(int $eventId)
    {
        $this->eventId = $eventId;
    }

    public function get(): EventAgenda
    {
        try {
            $response = CTClient::getClient()->get('/api/events/' . $this->eventId . '/agenda');
            return EventAgenda::createModelFromData(CTResponseUtil::dataAsArray($response));
        } catch (GuzzleException $e) {
            return new CTRequestException("Could not retrieve EventAgenda", null, $e);
        }
    }
}