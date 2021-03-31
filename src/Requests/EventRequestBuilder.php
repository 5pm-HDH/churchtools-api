<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\Event;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use Exception;

class EventRequestBuilder
{
    use Pagination, WhereCondition;

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
            throw new Exception("Failed! Person not found!");
        }
    }

    public function find(int $id): ?Event
    {
        $response = CTClient::getClient()->get('/api/events/' . $id);

        $eventData = CTResponseUtil::dataAsArray($response);
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

        return Event::createModelsFromArray($data);
    }
}