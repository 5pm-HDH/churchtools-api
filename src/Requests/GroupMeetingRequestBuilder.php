<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\GroupMeeting;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;

class GroupMeetingRequestBuilder
{
    use WhereCondition;

    public function __construct(
        protected int $groupId
    )
    {
    }

    public function get(): array
    {
        $options = [];

        $this->addWhereConditionsToOption($options);

        $client = CTClient::getClient();
        $response = $client->get("/api/groups/" . $this->groupId . "/meetings", $options);
        $data = CTResponseUtil::dataAsArray($response);

        return GroupMeeting::createModelsFromArray($data);
    }
}