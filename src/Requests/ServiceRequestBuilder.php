<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Service;
use CTApi\Requests\Traits\Pagination;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class ServiceRequestBuilder
{
    use Pagination;

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/services', []);
        return Service::createModelsFromArray($data);
    }

    public function findOrFail(int $id): Service
    {
        $service = $this->find($id);
        if ($service != null) {
            return $service;
        } else {
            throw new CTRequestException("Service could not be found!");
        }
    }

    public function find(int $id): ?Service
    {
        $serviceData = null;
        try {
            $serviceData = CTResponseUtil::dataAsArray(CTClient::getClient()->get('/api/services/' . $id));
        } catch (GuzzleException $e) {
            CTLog::getLog()->info('ServiceRequestBuilder: Could not get Service with Id' . $id);
        }

        if (empty($serviceData)) {
            return null;
        } else {
            return Service::createModelFromData($serviceData);
        }
    }
}