<?php


namespace CTApi\Utils;


use CTApi\CTLog;
use Psr\Http\Message\ResponseInterface;

class CTResponseUtil
{
    public static function jsonToObject(ResponseInterface $response)
    {
        return json_decode($response->getBody()->__toString(), true);
    }

    public static function jsonToArray(ResponseInterface $response): array
    {
        $object = CTResponseUtil::jsonToObject($response);

        if ($object == null) {
            return [];
        } else {
            $data = (array)$object;
            CTLog::logHttpData($data);
            return $data;
        }
    }

    public static function dataAsArray(ResponseInterface $response): array
    {
        $responseArray = self::jsonToArray($response);

        if (array_key_exists('data', $responseArray)) {
            return $responseArray['data'];
        } else {
            return [];
        }
    }

    public static function metaAsArray(ResponseInterface $response): array
    {
        $responseArray = self::jsonToArray($response);

        if (array_key_exists('meta', $responseArray)) {
            return $responseArray['meta'];
        } else {
            return [];
        }
    }
}