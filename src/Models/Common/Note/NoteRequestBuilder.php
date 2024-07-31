<?php

namespace CTApi\Models\Common\Note;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

class NoteRequestBuilder
{
    public function __construct(protected string $domainType, protected int $domainIdentifier)
    {
    }

    protected function getApiEndpoint(): string
    {
        return "/api/notes/" . $this->domainType . "/" . $this->domainIdentifier;
    }


    /**
     * @return Note[]
     */
    public function get(): array
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->get($this->getApiEndpoint());
        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return [];
        } else {
            return Note::createModelsFromArray($data);
        }
    }

    public function delete(int $noteId): void
    {
        $ctClient = CTClient::getClient();
        $ctClient->delete($this->getApiEndpoint() . "/" . $noteId);
    }

    public function create(string $text, ?int $securityLevelId = null): ?Note
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->post($this->getApiEndpoint(), [
            "json" => [
                "domainId" => "" . $this->domainIdentifier,
                "domainType" => $this->domainType,
                "securityLevelId" => $securityLevelId,
                "text" => $text,
            ]
        ]);

        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return null;
        } else {
            return Note::createModelFromData($data);
        }
    }

    public function update(int $noteId, string $text, ?int $securityLevelId = null): ?Note
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->put($this->getApiEndpoint() . '/' . $noteId, [
            "json" => [
                "text" => $text,
                "securityLevelId" => $securityLevelId,
            ]
        ]);

        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return null;
        } else {
            return Note::createModelFromData($data);
        }
    }
}
