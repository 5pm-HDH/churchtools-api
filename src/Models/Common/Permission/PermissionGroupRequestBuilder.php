<?php


namespace CTApi\Models\Common\Permission;


use CTApi\CTClient;
use CTApi\Models\Groups\Group\InternalGroupPermission;
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