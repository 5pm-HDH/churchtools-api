<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\GroupHomepage;
use CTApi\Utils\CTResponseUtil;

class PublicGroupRequestBuilder
{

    private $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function get(): GroupHomepage
    {
        $client = CTClient::getClient();
        $response = $client->get('api/grouphomepages/' . $this->hash);
        $data = CTResponseUtil::dataAsArray($response);
        return GroupHomepage::createModelFromData($data);
    }

}