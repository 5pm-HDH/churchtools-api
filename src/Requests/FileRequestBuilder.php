<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\File;
use CTApi\Utils\CTResponseUtil;

class FileRequestBuilder
{
    public function __construct(
        private string $domainType,
        private int $domainIdentifier
    )
    {
    }

    private function getApiEndpoint(): string
    {
        return "/api/files/" . $this->domainType . "/" . $this->domainIdentifier;
    }

    public function get(): ?File
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->get($this->getApiEndpoint());
        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return null;
        } else {
            return File::createModelFromData($data);
        }
    }

    public function delete(): void
    {
        $ctClient = CTClient::getClient();
        $ctClient->delete($this->getApiEndpoint());
    }

    public function upload(string $filePath): ?File
    {
        if (!file_exists($filePath)) {
            throw new CTModelException("Could not load file: " . $filePath);
        }

        $csrfToken = CSRFTokenRequest::getOrFail();

        $ctClient = CTClient::getClient();
        $response = $ctClient->post($this->getApiEndpoint(),
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                    'CSRF-Token' => $csrfToken
                ],
                'multipart' => [
                    [
                        'name' => 'files',
                        'contents' => file_get_contents($filePath),
                    ]
                ]
            ]);
        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return null;
        } else {
            return File::createModelFromData($data);
        }
    }
}