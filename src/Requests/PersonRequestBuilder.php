<?php


namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Person;
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
            throw CTRequestException::ofModelNotFound("Person", $e);
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

    /**
     * Update the person's data on churchtools.
     *
     * @param array $attributesToUpdate
     *        Pass the attributes that should be updated as array. If nothing or
     *        an empty array is passed, all data of the person will be sent to the API.
     *        If an array is passed that looks like this:
     *        <code>['firstName', 'lastName', 'nickname']</code>
     *        only those attributes will be sent to the API.
     */
    public function update(Person $person, array $attributesToUpdate = []): void
    {
        $id = $person->getId();
        if (is_null($id)) {
            throw new CTModelException("ID of Person cannot be null.");
        } else {
            $this->updateDataForModel($person, $id, $attributesToUpdate);
        }
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