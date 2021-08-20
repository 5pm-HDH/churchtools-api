<?php


namespace CTApi\Requests;


use CTApi\Models\Song;

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