<?php

namespace CTApi\Models\Groups\GroupMember;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Utils\CTResponseUtil;

class GroupMemberUpdateRequestBuilder
{
    public function __construct(
        private int $groupId
    ) {
    }

    public function addMember(int $personId): GroupMember
    {
        $client = CTClient::getClient();
        $response = $client->put("/api/groups/" . $this->groupId . "/members/" . $personId);
        $data = CTResponseUtil::dataAsArray($response);
        return GroupMember::createModelFromData($data);
    }

    public function updateMember(GroupMember $groupMember)
    {
        if (is_null($groupMember->getPersonId())) {
            throw new CTModelException("Person Id of GroupMember cannot be null.");
        }
        $updateAttributes = $groupMember->getModifiableAttributes();
        $allData = $groupMember->extractData();
        $updateAttributes = array_intersect_key($allData, array_flip($updateAttributes));

        $client = CTClient::getClient();
        $response = $client->put("/api/groups/" . $this->groupId . "/members/" . $groupMember->getPersonId(), [
            "json" => $updateAttributes
        ]);
    }

    public function removeMember(int $personId): void
    {
        $client = CTClient::getClient();
        $client->delete("/api/groups/" . $this->groupId . "/members/" . $personId);
    }
}
