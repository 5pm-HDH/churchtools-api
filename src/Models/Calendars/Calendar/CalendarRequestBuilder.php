<?php

namespace CTApi\Models\Calendars\Calendar;

use CTApi\Models\AbstractRequestBuilder;

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
