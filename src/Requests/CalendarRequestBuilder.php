<?php


namespace CTApi\Requests;


use CTApi\Models\Calendar;

class CalendarRequestBuilder extends AbstractRequestBuilder
{
    protected function getApiEndpoint(): string
    {
        return "/api/calendars";
    }

    protected function getModelClass(): string
    {
        return Calendar::class;
    }
}