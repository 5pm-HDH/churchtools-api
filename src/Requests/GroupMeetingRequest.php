<?php


namespace CTApi\Requests;


class GroupMeetingRequest
{
    public static function forGroup(int $group): GroupMeetingRequestBuilder
    {
        return new GroupMeetingRequestBuilder($group);
    }
}