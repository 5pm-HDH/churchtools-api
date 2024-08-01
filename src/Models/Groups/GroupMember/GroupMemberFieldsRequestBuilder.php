<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class GroupMemberFieldsRequestBuilder
{
    public function __construct(
        private int $groupId
    ) {
    }

    /**
     * @return GroupMemberFieldContainer[]
     */
    public function get(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/groups/' . $this->groupId . '/memberfields');
        $data = CTResponseUtil::dataAsArray($response);
        return GroupMemberFieldContainer::createModelsFromArray($data);
    }
}
