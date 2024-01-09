<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;

class GroupMemberRequestBuilder
{
    use Pagination;
    use OrderByCondition;

    private int $groupId;

    public function __construct(int $groupId)
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
