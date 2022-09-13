<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Absence;

class AbsencePersonRequestBuilder extends AbstractRequestBuilder
{
    public function __construct(
        private int $personId
    )
    {
    }

    protected function getApiEndpoint(): string
    {
        return '/api/persons/' . $this->personId . '/absences';
    }

    protected function getModelClass(): string
    {
        return Absence::class;
    }

    public function get(): array
    {
        $options = [];

        $this->addWhereConditionsToOption($options);
        $data = $this->collectDataFromPages($this->getApiEndpoint(), $options);
        $this->orderRawData($data);

        return Absence::createModelsFromArray($data);
    }

    public function create(Absence $absence): void
    {
        $id = $absence->getId();
        if (!is_null($id)) {
            throw new CTModelException("ID of a new Absence has to be null.");
        }

        $this->createDataForModel($absence);
    }

    /**
     * Update the absence data on churchtools.
     *
     * @param array $attributesToUpdate
     *        Pass the attributes that should be updated as array. If nothing or
     *        an empty array is passed, all data of the person will be sent to the API.
     */
    public function update(Absence $absence, array $attributesToUpdate = []): void
    {
        $id = $absence->getId();
        if (is_null($id)) {
            throw new CTModelException("ID of Absence cannot be null.");
        } else {
            $this->updateDataForModel($absence, $id, $attributesToUpdate);
        }
    }

    /**
     * Update object's data in ChurchTools by the given object ID.
     * @param string $objectId
     * @param array $data Key-Value pair with attributes
     */
    protected function updateData(string $objectId, array $data): void
    {
        $url = $this->getApiEndpoint() . '/' . $objectId;

        $client = CTClient::getClient();
        $client->put($url, ['json' => $data]);
    }

    public function delete(Absence $absence): void
    {
        $id = $absence->getId();

        if (is_null($id)) {
            throw new CTModelException("ID of Absence cannot be null.");
        }

        $this->deleteData($id);
    }

}