<?php


namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Person;
use CTApi\Utils\CTResponseUtil;

class PersonRequestBuilder extends AbstractRequestBuilder
{
    public function whoami(): Person
    {
        $client = CTClient::getClient();
        $response = $client->get('/api/whoami');
        $data = CTResponseUtil::dataAsArray($response);
        return Person::createModelFromData($data);
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
     * Add the person to ChurchTools.
     *
     * @param bool $force
     *        If the request fails because a duplicate is found (person with same name)
     *        set the $force param to `true` to create this person even if a
     *        duplicate is found.
     * @throws CTModelException If the passed person already has an ID.
     */
    public function create(Person $person, bool $force = false): void
    {
        $id = $person->getId();
        if (!is_null($id)) {
            throw new CTModelException("ID of a new Person has to be null.");
        }

        $this->createDataForModel($person, $force);
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

    public function delete(Person $person): void
    {
        $id = $person->getId();

        if (is_null($id)) {
            throw new CTModelException("ID of Person cannot be null.");
        }

        $this->deleteData($id);
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