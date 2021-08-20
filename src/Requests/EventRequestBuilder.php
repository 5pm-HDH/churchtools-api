<?php


namespace CTApi\Requests;


use CTApi\Models\Event;

class EventRequestBuilder extends AbstractRequestBuilder
{

    protected function getApiEndpoint(): string
    {
        return '/api/events';
    }

    protected function getModelClass(): string
    {
        return Event::class;
    }
}