<?php

namespace CTApi\Models\Events\Service;

use CTApi\Models\AbstractRequestBuilder;

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
