<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

abstract class GroupHierarchieAbstractRequest
{
    private $groupId;

    public function __construct(int $groupId)
    {
        $this->groupId = $groupId;
    }

    protected function requestHierarchieObject()
    {
        $client = CTClient::getClient();
        $response = $client->get('api/groups/hierarchies', [
            'json' => [
                'ids' => [$this->groupId]
            ]
        ]);
        return CTResponseUtil::dataAsArray($response);
    }

    abstract public function get(): array;
}