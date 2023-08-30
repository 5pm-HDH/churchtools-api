<?php


namespace CTApi\Models\Calendars\Resource;


use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class ResourceRequestBuilder
{
    public function all(): array
    {
        $client = CTClient::getClient();
        $response = $client->get("/api/resource/masterdata");

        $metaInformation = CTResponseUtil::metaAsArray($response);
        $data = CTResponseUtil::dataAsArray($response);

        $resourceTypeMap = []; // id => ResourceType

        if (array_key_exists("resourceTypes", $data)) {
            foreach ($data["resourceTypes"] as $resourceData) {
                $resourceType = ResourceType::createModelFromData($resourceData);
                $resourceTypeMap[$resourceData["id"]] = $resourceType;
            }
        }

        $resources = [];

        if (array_key_exists("resources", $data)) {
            $resources = array_map(function ($resourceData) use ($resourceTypeMap) {
                $resourceObject = Resource::createModelFromData($resourceData);

                $resourceTypeId = $resourceObject->getResourceTypeId();
                if (!is_null($resourceTypeId) && $resourceTypeId != "") {
                    if (array_key_exists($resourceTypeId, $resourceTypeMap)) {
                        $resourceObject->setResourceType($resourceTypeMap[$resourceTypeId]);
                    }
                }
                return $resourceObject;
            }, $data["resources"]);
        }

        return $resources;
    }
}