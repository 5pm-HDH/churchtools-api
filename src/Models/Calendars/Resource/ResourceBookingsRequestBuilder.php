<?php


namespace CTApi\Models\Calendars\Resource;


use CTApi\CTClient;
use CTApi\Traits\Request\WhereCondition;
use CTApi\Utils\CTResponseUtil;

class ResourceBookingsRequestBuilder
{
    use WhereCondition;

    private array $resourceIds;

    public function __construct(array $resourceIds)
    {
        $this->resourceIds = $resourceIds;
    }

    public function get(): array
    {
        $options = [];
        $this->where("resource_ids", $this->resourceIds);
        $this->addWhereConditionsToOption($options);

        $client = CTClient::getClient();
        $response = $client->get("/api/bookings", $options);

        $rawData = CTResponseUtil::jsonToArray($response);

        $metaInformation = CTResponseUtil::metaAsArray($response);
        $data = CTResponseUtil::dataAsArray($response);

        return ResourceBooking::createModelsFromArray($data);
    }


}