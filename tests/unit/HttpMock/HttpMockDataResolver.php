<?php

namespace Tests\Unit\HttpMock;

use CTApi\CTLog;
use CTApi\Utils\CTUtil;

class HttpMockDataResolver
{
    const HTTP_DATA_DIR = __DIR__ . '/data/';

    static function resolveEndpoint(string $endpoint, array $options = []): array
    {
        CTLog::getLog()->debug("HttpMockDataResolver. Resolve endpoint: " . $endpoint);
        return self::getData($endpoint, $options);
    }

    private static function getData(string $endpoint, array $options): array
    {
        $jsonFileName = self::convertEndpointToFileName($endpoint, $options);
        CTLog::getLog()->debug("HttpMockDataResolver. Load Json-File: " . $jsonFileName);
        if (file_exists($jsonFileName)) {
            $fileContent = file_get_contents($jsonFileName);
            if ($fileContent != false) {
                return json_decode($fileContent, true);
            }
        }
        CTLog::getLog()->debug("HttpMockDataResolver. Could not retrieve Json-File: " . $jsonFileName);

        return [];
    }

    private static function convertEndpointToFileName(string $endpoint, array $options): string
    {
        // Remove "/" if String starts with it
        if ($endpoint[0] == '/') {
            $endpoint = substr($endpoint, 1);
        }
        // convert string to lowercase
        $endpoint = strtolower($endpoint);

        $pageNr = CTUtil::arrayPathGet($options, "json.page");
        if (!is_null($pageNr) && $pageNr > 1) {
            $endpoint .= "_page_" . $pageNr;
            CTLog::getLog()->debug("Append Page-Number to Endpoint-Filename: " . $endpoint);
        }

        return self::HTTP_DATA_DIR . str_replace('/', '_', strtolower($endpoint)) . '.json';
    }
}