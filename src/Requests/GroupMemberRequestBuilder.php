<?php


namespace CTApi\Requests;


use CTApi\Models\GroupMember;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;

class GroupMemberRequestBuilder
{
    use Pagination, OrderByCondition;

    private int $groupId;

    function __construct(int $groupId)
    {
        $this->groupId = $groupId;
    }

    public function get(): array
    {
        $data = $this->collectDataFromPages('/api/groups/' . $this->groupId . '/members');
        $this->orderRawData($data);

        return GroupMember::createModelsFromArray($data);
    }

}