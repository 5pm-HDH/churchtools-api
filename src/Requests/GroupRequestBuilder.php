<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Event;
use CTApi\Models\Group;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

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