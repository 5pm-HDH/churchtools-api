<?php

namespace CTApi\Models\Groups\GroupTypeRole;

use CTApi\Models\AbstractRequestBuilder;

class GroupTypeRoleRequestBuilder extends AbstractRequestBuilder
{
    protected function getApiEndpoint(): string
    {
        return '/api/group/roles';
    }

    protected function getModelClass(): string
    {
        return GroupTypeRole::class;
    }
}
