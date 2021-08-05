<?php


class HttpMockDataResolver
{

    const HTTP_DATA_DIR = __DIR__ . '/data/';

    static function resolveEndpoint(string $endpoint): array
    {
        return self::getData($endpoint);
    }

    private static function getData(string $endpoint): array
    {
        $jsonFileName = self::convertEndpointToFileName($endpoint);
        if (file_exists($jsonFileName)) {
            $fileContent = file_get_contents($jsonFileName);
            if ($fileContent != false) {
                return json_decode($fileContent, true);
            }
        }

        return [];
    }

    private static function convertEndpointToFileName(string $endpoint): string
    {
        // Remove "/" if String starts with it
        if ($endpoint[0] == '/') {
            $endpoint = substr($endpoint, 1);
        }

        return self::HTTP_DATA_DIR . str_replace('/', '_', strtolower($endpoint)) . '.json';
    }
}