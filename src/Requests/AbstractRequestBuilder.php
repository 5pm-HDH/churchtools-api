<?php


namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Interfaces\UpdatableModel;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;

abstract class AbstractRequestBuilder
{

    use Pagination, WhereCondition, OrderByCondition;

    public function all(): array
    {
        $data = $this->collectDataFromPages($this->getApiEndpoint(), []);
        return $this->getModelClass()::createModelsFromArray($data);
    }

    public function findOrFail(int $id)
    {
        $model = $this->find($id);
        if ($model != null) {
            return $model;
        } else {
            throw CTRequestException::ofModelNotFound($this->getModelClass());
        }
    }

    public function find(int $id)
    {
        $modelData = null;
        try {
            $response = CTClient::getClient()->get($this->getApiEndpoint() . '/' . $id);
            $modelData = CTResponseUtil::dataAsArray($response);
        } catch (CTRequestException $e) {
            // ignore
        }

        if (empty($modelData)) {
            return null;
        } else {
            return $this->getModelClass()::createModelFromData($modelData);
        }
    }

    public function get(): array
    {
        $options = [];
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages($this->getApiEndpoint(), $options);

        $this->orderRawData($data);

        return $this->getModelClass()::createModelsFromArray($data);
    }

    /**
     * Send Update-Request for given Model. Only update Attributes that are given with the updateAttributes-Parameter.
     *
     * @param UpdatableModel $model Model
     * @param string $modelId Id of Model
     * @param array $updateAttributes Pass the attributes that should be updated as array. If nothing or
     *        an empty array is passed, all data of the person will be sent to the API.
     *        If an array is passed that looks like this:
     *        <code>['firstName', 'lastName', 'nickname']</code>
     *        only those attributes will be sent to the API.
     */
    protected function updateDataForModel(UpdatableModel $model, string $modelId, array $updateAttributes): void
    {
        if (empty($updateAttributes)) {
            $updateAttributes = $model->getModifiableAttributes();
        } else {
            $diff = array_diff($updateAttributes, $model->getModifiableAttributes());

            if ($diff) {
                throw new CTModelException('The attributes ' . implode(', ', $diff) . ' of Model ' . get_class($model) . ' are not modifiable.');
            }
        }

        $allData = $model->extractData();
        $updateAttributes = array_intersect_key($allData, array_flip($updateAttributes));

        $this->updateData($modelId, $updateAttributes);
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
        $client->patch($url, ['json' => $data]);
    }

    /**
     * Delete the object in ChurchTools by given Id.
     * @param string $modelId
     */
    public function deleteData(string $modelId): void
    {
        $url = $this->getApiEndpoint() . '/' . $modelId;

        $client = CTClient::getClient();
        $client->delete($url);
    }

    abstract protected function getApiEndpoint(): string;

    abstract protected function getModelClass(): string;
}