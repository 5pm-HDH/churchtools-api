<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\ServiceGroup;
use CTApi\Requests\Traits\Pagination;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class ServiceGroupRequestBuilder
{
    use Pagination;

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/servicegroups', []);
        return ServiceGroup::createModelsFromArray($data);
    }

    public function findOrFail(int $id): ServiceGroup
    {
        $serviceGroup = $this->find($id);
        if ($serviceGroup != null) {
            return $serviceGroup;
        } else {
            throw new CTRequestException("ServiceGroup could not be found!");
        }
    }

    public function find(int $id): ?ServiceGroup
    {
        $serviceGroupData = null;
        try {
            $serviceGroupData = CTResponseUtil::dataAsArray(CTClient::getClient()->get('/api/servicegroups/' . $id));
        } catch (GuzzleException $e) {
            CTLog::getLog()->info('ServiceGroupRequestBuilder: Could not get ServiceGroup with Id' . $id);
        }

        if (empty($serviceGroupData)) {
            return null;
        } else {
            return ServiceGroup::createModelFromData($serviceGroupData);
        }
    }
}