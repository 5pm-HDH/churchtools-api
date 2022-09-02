<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\BirthdayPerson;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;

class PersonBirthdayRequestBuilder
{
    use WhereCondition;


    public function get(): array
    {
        $options = [];

        $this->addWhereConditionsToOption($options);

        $client = CTClient::getClient();
        $response = $client->get('api/persons/birthdays', $options);
        $data = CTResponseUtil::dataAsArray($response);
        return BirthdayPerson::createModelsFromArray($data);
    }
}