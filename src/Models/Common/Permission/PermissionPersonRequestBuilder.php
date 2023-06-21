<?php


namespace CTApi\Models\Common\Permission;


use CTApi\CTClient;
use CTApi\Models\Groups\Person\InternalPersonPermission;
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