<?php

namespace CTApi\Models\Events\Service;

use CTApi\Models\AbstractRequestBuilder;

class ServiceGroupRequestBuilder extends AbstractRequestBuilder
{
    protected function getApiEndpoint(): string
    {
        return '/api/servicegroups';
    }

    protected function getModelClass(): string
    {
        return ServiceGroup::class;
    }
}
