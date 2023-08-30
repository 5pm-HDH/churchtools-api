<?php


namespace CTApi\Models\Groups\Group;


use CTApi\Models\AbstractRequestBuilder;

class GroupRequestBuilder extends AbstractRequestBuilder
{

    protected function getApiEndpoint(): string
    {
        return '/api/groups';
    }

    protected function getModelClass(): string
    {
        return Group::class;
    }
}