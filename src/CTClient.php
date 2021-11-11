<?php


namespace CTApi;


use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTConnectException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
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
        try {
            CTLog::getLog()->debug('CTClient: GET-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse(parent::get($uri, self::mergeOptions($options)));
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        try {
            CTLog::getLog()->debug('CTClient: POST-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse(parent::post($uri, self::mergeOptions($options)));
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    private function handleResponse(ResponseInterface $response): ResponseInterface
    {
        switch ($response->getStatusCode()) {
            case 401:
                throw new CTAuthException("Unauthorized.", 401);
        }
        return $response;
    }

    private function handleException(Exception $exception): ResponseInterface
    {
        if ($exception instanceof ConnectException) {
            throw new CTConnectException($exception->getMessage(), $exception->getCode(), $exception);
        }
        throw $exception;
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