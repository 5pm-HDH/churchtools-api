<?php

namespace CTApi\Models\Groups\Group;

use CTApi\CTClient;
use CTApi\Models\Common\Tag\Tag;
use CTApi\Utils\CTResponseUtil;

class GroupTagRequestBuilder
{
    public function __construct(
        private int $groupId
    ) {
    }

    public function get(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/groups/'.$this->groupId.'/tags');
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }
}
