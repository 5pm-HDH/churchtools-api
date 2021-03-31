<?php


namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Models\Person;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class PersonRequestBuilder
{
    use Pagination, WhereCondition;

    public function whoami(): Person
    {
        $client = CTClient::getClient();

        try {
            $response = $client->get('/api/whoami');

            $data = CTResponseUtil::dataAsArray($response);

            return Person::createModelFromData($data);
        } catch (GuzzleException $e) {
            throw new Exception($e);
        }
    }

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/persons', []);
        return Person::createModelsFromArray($data);
    }

    public function findOrFail(int $id): Person
    {
        $person = $this->find($id);
        if ($person != null) {
            return $person;
        } else {
            throw new Exception("Failed! Person not found!");
        }
    }

    public function find(int $id): ?Person
    {
        $response = CTClient::getClient()->get('/api/persons/' . $id);

        $personData = CTResponseUtil::dataAsArray($response);
        if (empty($personData)) {
            return null;
        } else {
            return Person::createModelFromData($personData);
        }
    }

    public function get(): array
    {
        $options = [
            "json" => []
        ];

        //Where-Clauses
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/persons', $options);

        return Person::createModelsFromArray($data);
    }
}