<?php


namespace CTApi\Requests;


use CTApi\Models\GroupMember;

class GroupMemberRequest
{
    public static function get(int $groupId): GroupMemberRequestBuilder
    {
        return new GroupMemberRequestBuilder($groupId);
    }

    public static function addMember(int $groupId, int $personId): GroupMember
    {
        return (new GroupMemberUpdateRequestBuilder($groupId))->addMember($personId);
    }

    public static function updateMember(int $groupId, GroupMember $groupMember): void
    {
        (new GroupMemberUpdateRequestBuilder($groupId))->updateMember($groupMember);
    }

    public static function removeMember(int $groupId, int $personId): void
    {
        (new GroupMemberUpdateRequestBuilder($groupId))->removeMember($personId);
    }
}