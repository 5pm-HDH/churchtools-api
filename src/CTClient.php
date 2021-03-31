<?php


namespace CTApi;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class CTClient extends Client
{
    private static ?CTClient $client = null;

    private static function mergeOptions(array $options): array
    {
        return array_merge_recursive($options, CTConfig::getRequestConfig());
    }

    public function get($uri, array $options = []): ResponseInterface
    {
        return parent::get($uri, self::mergeOptions($options));
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        return parent::post($uri, self::mergeOptions($options));
    }

    public static function getClient(): CTClient
    {
        if (is_null(self::$client)) {
            self::$client = new CTClient();
        }
        return self::$client;
    }
}