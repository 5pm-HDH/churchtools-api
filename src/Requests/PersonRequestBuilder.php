<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\Person;
use CTApi\Requests\Traits\Pagination;
use CTApi\Utils\CTResponseUtil;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class PersonRequestBuilder
{
    use Pagination;

    private array $whereCriteria = [];

    public function whoami(): Person
    {
        $client = CTClient::getClient();

        try {
            $response = $client->get('/api/whoami');

            $data = CTResponseUtil::dataAsArray($response);

            $person = new Person();
            $person->fillWithData($data);

            return $person;
        } catch (GuzzleException $e) {
            throw new Exception($e);
        }
    }

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/persons', []);
        return $this->convertDataArrayToPersonArray($data);
    }

    public function where(string $key, $value): PersonRequestBuilder
    {
        $this->whereCriteria[$key] = $value;
        return $this;
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

        $person = new Person();
        $personData = CTResponseUtil::dataAsArray($response);
        if (empty($personData)) {
            return null;
        } else {
            $person->fillWithData($personData);
            return $person;
        }
    }

    public function get(): array
    {
        $options = [
            "json" => []
        ];

        //Where-Clauses
        foreach ($this->whereCriteria as $whereKey => $whereValue) {
            $options["json"][$whereKey] = $whereValue;
        }

        $data = $this->collectDataFromPages('/api/persons', $options);

        return $this->convertDataArrayToPersonArray($data);
    }

    private function convertDataArrayToPersonArray(array $personDataArray): array
    {
        return array_map(function ($personRecord) {
            $person = new Person();
            $person->fillWithData($personRecord);
            return $person;
        }, $personDataArray);
    }
}