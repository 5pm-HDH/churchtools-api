<?php


namespace CTApi\Models\Events\Event;


use CTApi\Models\AbstractRequestBuilder;

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