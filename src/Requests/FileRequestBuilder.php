<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Exceptions\CTModelException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\File;
use CTApi\Utils\CTMessageBody;
use CTApi\Utils\CTResponse;
use CTApi\Utils\CTResponseUtil;
use CTApi\Utils\CTUtil;

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

    public function get(): array
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->get($this->getApiEndpoint());
        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return [];
        } else {
            return File::createModelsFromArray($data);
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

        // Upload file with pure CURL
        $ch = curl_init(CTConfig::getApiUrl() . $this->getApiEndpoint() . "?login_token=" . CTConfig::getApiKey());
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "content-type:multipart/form-data",
            "csrf-token:" . $csrfToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ["files[]" => curl_file_create($filePath)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultString = (string)curl_exec($ch);
        $curlInfo = curl_getinfo($ch);
        CTLog::getLog()->debug("Upload-File Url: " . CTUtil::arrayPathGet($curlInfo, "url"));
        CTLog::getLog()->debug("Upload-File Http-Code: " . CTUtil::arrayPathGet($curlInfo, "http_code"));
        curl_close($ch);

        try {
            $data = json_decode($resultString, true);
        } catch (\Exception $e) {
            CTLog::getLog()->warning("Could not convert upload response to JSON: ". $resultString);
            $data = [];
        }

        $statusCode = array_key_exists("http_code", $curlInfo) ? $curlInfo["http_code"] : 400;
        if ($statusCode >= 200 && $statusCode <= 299) {
            if (empty($data)) {
                return null;
            } else {
                return File::createModelFromData(CTUtil::arrayPathGet($data, "data"));
            }
        } else {
            $ctResponse = CTResponse::createEmpty();
            $ctResponse->withBody(new CTMessageBody($data));
            throw CTRequestException::ofErrorResponse($ctResponse);
        }
    }
}