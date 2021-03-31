<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Event
{
    use FillWithData;

    protected function parseArray(string $key, array $data)
    {
        $this->{$key} = $data;
    }
}