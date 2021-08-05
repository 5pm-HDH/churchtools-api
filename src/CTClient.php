<?php


namespace CTApi;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

class CTClient extends Client
{
    private static ?CTClient $client = null;

    protected static function mergeOptions(array $options): array
    {
        return array_merge_recursive($options, CTConfig::getRequestConfig());
    }

    public function get($uri, array $options = []): ResponseInterface
    {
        CTLog::getLog()->debug('CTClient: GET-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
        return parent::get($uri, self::mergeOptions($options));
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        CTLog::getLog()->debug('CTClient: POST-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
        return parent::post($uri, self::mergeOptions($options));
    }

    public static function getClient(): CTClient
    {
        if (is_null(self::$client)) {
            self::createClient();
        }
        return self::$client;
    }

    public static function setClient(CTClient $client)
    {
        self::$client = $client;
    }

    public static function createClient(?HandlerStack $handlerStack = null): void
    {
        if (is_null($handlerStack)) {
            self::$client = new CTClient();
        } else {
            self::$client = new CTClient(['handler' => $handlerStack]);
        }
    }
}