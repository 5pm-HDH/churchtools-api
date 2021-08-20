<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\ServiceGroup;
use CTApi\Requests\Traits\Pagination;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

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