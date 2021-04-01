<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Event;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class EventRequestBuilder
{
    use Pagination, WhereCondition, OrderByCondition;

    public function all(): array
    {
        $data = $this->collectDataFromPages('/api/events', []);
        return Event::createModelsFromArray($data);
    }

    public function findOrFail(int $id): Event
    {
        $event = $this->find($id);
        if ($event != null) {
            return $event;
        } else {
            throw new CTModelException("Could not retrieve model!");
        }
    }

    public function find(int $id): ?Event
    {
        $eventData = null;
        try {
            $response = CTClient::getClient()->get('/api/events/' . $id);
            $eventData = CTResponseUtil::dataAsArray($response);
        } catch (GuzzleException $e) {
            // ignore
        }

        if (empty($eventData)) {
            return null;
        } else {
            return Event::createModelFromData($eventData);
        }
    }

    public function get(): array
    {
        $options = [];
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/events', $options);

        $this->orderRawData($data);

        return Event::createModelsFromArray($data);
    }
}