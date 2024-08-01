<?php

namespace CTApi\Models\Groups\Group;

use CTApi\CTClient;
use CTApi\Exceptions\CTPermissionException;
use CTApi\Utils\CTResponseUtil;

class GroupHierarchieChildrenRequest
{
    public function __construct(private readonly int $groupId)
    {
    }

    /**
     * @return Group[]
     */
    public function get(): array
    {
        $response = CTClient::getClient()->get('api/groups/' . $this->groupId . '/children');
        $data = CTResponseUtil::dataAsArray($response);
        return Group::createModelsFromArray($data);
    }
}
