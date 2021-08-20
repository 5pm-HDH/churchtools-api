<?php


namespace CTApi\Requests;


use CTApi\Models\Group;
use CTApi\Models\PersonGroup;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;

class PersonGroupRequestBuilder
{
    use Pagination, OrderByCondition;

    private int $personId;

    public function __construct(int $personId)
    {
        $this->personId = $personId;
    }

    public function get(): array
    {
        $data = $this->collectDataFromPages('/api/persons/' . $this->personId . '/groups');
        $this->orderRawData($data);

        return PersonGroup::createModelsFromArray($data);
    }

}