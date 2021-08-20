<?php


namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Person;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class PersonRequestBuilder extends AbstractRequestBuilder
{
    public function whoami(): Person
    {
        $client = CTClient::getClient();

        try {
            $response = $client->get('/api/whoami');

            $data = CTResponseUtil::dataAsArray($response);

            return Person::createModelFromData($data);
        } catch (GuzzleException $e) {
            throw new CTModelException("Person could not be found.", null, $e);
        }
    }

    public function get(): array
    {
        $options = [
            "json" => []
        ];

        //Where-Clauses
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages($this->getApiEndpoint(), $options);

        $this->orderRawData($data);

        return Person::createModelsFromArray($data);
    }

    protected function getApiEndpoint(): string
    {
        return '/api/persons';
    }

    protected function getModelClass(): string
    {
        return Person::class;
    }
}