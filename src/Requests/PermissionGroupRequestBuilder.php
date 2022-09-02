<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\InternalGroupPermission;
use CTApi\Utils\CTResponseUtil;

class PermissionGroupRequestBuilder
{
    public function __construct(
        private int $groupId
    )
    {
    }

    public function get(): InternalGroupPermission
    {
        $client = CTClient::getClient();
        $response = $client->get('api/permissions/internal/groups/' . $this->groupId);
        $data = CTResponseUtil::dataAsArray($response);
        return InternalGroupPermission::createModelFromData($data);
    }
}