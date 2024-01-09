<?php

namespace CTApi\Models\Common\Permission;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class PermissionGlobalRequestBuilder
{
    public function get()
    {
        $client = CTClient::getClient();
        $response = $client->get('api/permissions/global');
        $data = CTResponseUtil::dataAsArray($response);
        return PermissionGlobal::createModelFromData($data);
    }
}
