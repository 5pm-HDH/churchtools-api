<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\AbstractModel;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

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
            throw CTRequestException::ofModelNotFound();
        }
    }

    public function find(int $id)
    {
        $modelData = null;
        try {
            $response = CTClient::getClient()->get($this->getApiEndpoint() . '/' . $id);
            $modelData = CTResponseUtil::dataAsArray($response);
        } catch (GuzzleException $e) {
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

    abstract protected function getApiEndpoint(): string;

    abstract protected function getModelClass(): string;
}