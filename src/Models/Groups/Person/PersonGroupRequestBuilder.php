<?php

namespace CTApi\Models\Groups\Person;

use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;

class PersonGroupRequestBuilder
{
    use Pagination;
    use OrderByCondition;

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
