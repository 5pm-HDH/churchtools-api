<?php

namespace CTApi\Models\Groups\GroupMeeting;

class GroupMeetingRequest
{
    public static function forGroup(int $group): GroupMeetingRequestBuilder
    {
        return new GroupMeetingRequestBuilder($group);
    }
}
