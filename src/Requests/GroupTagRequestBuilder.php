<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\Tag;
use CTApi\Utils\CTResponseUtil;

class GroupTagRequestBuilder
{

    public function __construct(
        private int $groupId
    )
    {
    }

    public function get(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/groups/'.$this->groupId.'/tags');
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }
}