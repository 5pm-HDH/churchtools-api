<?php


namespace CTApi\Models\Common\Auth;


use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Utils\CTResponseUtil;

class CSRFTokenRequest
{
    public static function get(): ?string
    {
        $client = CTClient::getClient();
        $response = $client->get("/api/csrftoken");
        $responseAsArray = CTResponseUtil::jsonToArray($response);
        if (array_key_exists("data", $responseAsArray)) {
            return $responseAsArray["data"];
        }

        return null;
    }

    public static function getOrFail(): string
    {
        $csrfToken = self::get();
        if (is_null($csrfToken)) {
            throw new CTRequestException("Could not retrieve CSRF-Token");
        } else {
            return $csrfToken;
        }
    }
}