<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Service;
use CTApi\Requests\Traits\Pagination;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

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