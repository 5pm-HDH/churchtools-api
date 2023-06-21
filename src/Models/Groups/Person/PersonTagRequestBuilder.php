<?php


namespace CTApi\Models\Groups\Person;


use CTApi\CTClient;
use CTApi\Models\Common\Tag\Tag;
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