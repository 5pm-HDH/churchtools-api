<?php


namespace CTApi\Requests;


use CTApi\Models\Service;

class ServiceRequestBuilder extends AbstractRequestBuilder
{

    protected function getApiEndpoint(): string
    {
        return '/api/services';
    }

    protected function getModelClass(): string
    {
        return Service::class;
    }
}