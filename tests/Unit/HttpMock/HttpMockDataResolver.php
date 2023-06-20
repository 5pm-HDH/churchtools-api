<?php

namespace CTApi\Test\Unit\HttpMock;

use CTApi\CTLog;
use CTApi\Utils\CTUtil;

class HttpMockDataResolver
{
    const HTTP_DATA_DIR = __DIR__ . '/data/';

    static function resolveEndpoint(string $endpoint, array $options = [], string $method = "GET"): array
    {
        CTLog::getLog()->debug("HttpMockDataResolver. Resolve endpoint: " . $endpoint);
        return self::getData($endpoint, $options, $method);
    }

    private static function getData(string $endpoint, array $options, string $method): array
    {
        $jsonFileName = self::convertEndpointToFileName($endpoint, $options, $method);
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

    private static function convertEndpointToFileName(string $endpoint, array $options, string $method): string
    {
        // Remove "/" if String starts with it
        if ($endpoint[0] == '/') {
            $endpoint = substr($endpoint, 1);
        }
        // convert string to lowercase
        $endpoint = strtolower($endpoint);

        // append page nr
        $pageNr = CTUtil::arrayPathGet($options, "query.page");
        if (!is_null($pageNr) && $pageNr > 1) {
            $endpoint .= "_page_" . $pageNr;
            CTLog::getLog()->debug("Append Page-Number to Endpoint-Filename: " . $endpoint);
        }

        // append query and func-name for AJAX-Request
        if($endpoint == "index.php"){
            $q = CTUtil::arrayPathGet($options, "query.q");
            if(!is_null($q)){
                $endpoint .= "_q=".$q;
            }
            $func = CTUtil::arrayPathGet($options, "json.func");
            if(!is_null($func)){
                $endpoint .= "_func=".$func;
            }
        }

        $file = str_replace('/', '_', strtolower($endpoint)) . '.json';
        if ($method != "GET") {
            $file = strtoupper($method) . "_" . $file;
        }
        CTLog::getLog()->debug("Load file: " . $file);
        return self::HTTP_DATA_DIR . $file;
    }
}