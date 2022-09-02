<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\InternalPersonPermission;
use CTApi\Utils\CTResponseUtil;

class PermissionPersonRequestBuilder
{
    public function __construct(
        private int $personId
    )
    {
    }

    public function get(): InternalPersonPermission
    {
        $client = CTClient::getClient();
        $response = $client->get('api/permissions/internal/persons/' . $this->personId);
        $data = CTResponseUtil::dataAsArray($response);
        return InternalPersonPermission::createModelFromData($data);
    }

}