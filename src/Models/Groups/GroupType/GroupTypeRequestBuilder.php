<?php

namespace CTApi\Models\Groups\GroupType;

use CTApi\Models\AbstractRequestBuilder;

class GroupTypeRequestBuilder extends AbstractRequestBuilder
{
    protected function getApiEndpoint(): string
    {
        return '/api/group/grouptypes';
    }

    protected function getModelClass(): string
    {
        return GroupType::class;
    }
}
