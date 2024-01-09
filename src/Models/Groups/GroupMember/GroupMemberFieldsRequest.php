<?php

namespace CTApi\Models\Groups\GroupMember;

class GroupMemberFieldsRequest
{
    public static function forGroup(int $groupId): GroupMemberFieldsRequestBuilder
    {
        return new GroupMemberFieldsRequestBuilder($groupId);
    }
}
