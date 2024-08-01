<?php

namespace CTApi\Models\Calendars\Calendar;

class CalendarRequest
{
    /**
     * @return Calendar[]
     */
    public static function all(): array
    {
        return (new CalendarRequestBuilder())->all();
    }

    public static function orderBy(string $key, $orderAscending = true): CalendarRequestBuilder
    {
        return (new CalendarRequestBuilder())->orderBy($key, $orderAscending);
    }
}
