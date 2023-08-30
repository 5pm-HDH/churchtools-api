<?php


namespace CTApi\Models\Events\Song;


use CTApi\Models\AbstractRequestBuilder;

class SongRequestBuilder extends AbstractRequestBuilder
{
    protected function getApiEndpoint(): string
    {
        return '/api/songs';
    }

    protected function getModelClass(): string
    {
        return Song::class;
    }
}