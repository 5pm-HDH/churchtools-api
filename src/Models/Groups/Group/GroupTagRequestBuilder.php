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
        $response = $client->get('/api/tags/group/'.$this->groupId);
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }
}
