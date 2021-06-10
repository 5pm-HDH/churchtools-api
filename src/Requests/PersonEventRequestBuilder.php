<?php


namespace CTApi\Requests;


use CTApi\Models\Event;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;

class PersonEventRequestBuilder
{

    use Pagination, WhereCondition, OrderByCondition;

    private int $personId;

    public function __construct(int $personId)
    {
        $this->personId = $personId;
    }

    public function get(): array
    {
        $options = [];

        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/persons/' . $this->personId . '/events');

        $this->orderRawData($data);

        return Event::createModelsFromArray($data);
    }
}