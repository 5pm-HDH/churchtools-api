<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\Tag;
use CTApi\Utils\CTResponseUtil;

class PersonTagRequestBuilder
{

    public function __construct(
        private int $personId
    )
    {
    }

    public function get(): array
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/persons/'.$this->personId.'/tags');
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }
}