<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\PermissionGlobal;
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