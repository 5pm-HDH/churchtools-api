<?php


namespace CTApi\Requests;


use CTApi\Models\ServiceGroup;

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