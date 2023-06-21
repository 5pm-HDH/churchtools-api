<?php


namespace CTApi\Models\Groups\Person;


use CTApi\Models\Events\Event\Event;
use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;
use CTApi\Traits\Request\WhereCondition;

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