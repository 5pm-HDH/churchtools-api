<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\GroupMeetingMember;
use CTApi\Utils\CTResponseUtil;

class GroupMeetingMemberRequestBuilder
{

    public function __construct(
        private int $groupId,
        private int $meetingId
    )
    {
    }

    public function get(): array
    {
        $client = CTClient::getClient();

        $response = $client->get("/api/groups/" . $this->groupId . "/meetings/" . $this->meetingId . "/members");
        $data = CTResponseUtil::dataAsArray($response);

        return GroupMeetingMember::createModelsFromArray($data);
    }

}