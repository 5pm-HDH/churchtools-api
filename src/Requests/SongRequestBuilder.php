<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Song;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class SongRequestBuilder
{
    use Pagination, WhereCondition, OrderByCondition;

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/songs', []);
        return Song::createModelsFromArray($data);
    }

    public function findOrFail(int $id): Song
    {
        $song = $this->find($id);
        if ($song != null) {
            return $song;
        } else {
            throw new CTModelException("Could not retrieve model!");
        }
    }

    public function find(int $id): ?Song
    {
        $songData = null;
        try {
            $response = CTClient::getClient()->get('/api/songs/' . $id);
            $songData = CTResponseUtil::dataAsArray($response);
        } catch (GuzzleException $e) {
            // ignore
        }

        if (empty($songData)) {
            return null;
        } else {
            return Song::createModelFromData($songData);
        }
    }

    public function get(): array
    {
        $options = [];
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/songs', $options);

        $this->orderRawData($data);

        return Song::createModelsFromArray($data);
    }

}