<?php


namespace Requests;


use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;
use Models\GroupMemberFieldContainer;

class GroupMemberFieldsRequestBuilder
{

    public function __construct(
        private int $groupId
    )
    {
    }

    public function get(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/groups/' . $this->groupId . '/memberfields');
        $data = CTResponseUtil::dataAsArray($response);
        return GroupMemberFieldContainer::createModelsFromArray($data);
    }
}