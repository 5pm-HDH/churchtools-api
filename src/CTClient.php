<?php


namespace CTApi;


use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTConnectException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

/**
 * @psalm-suppress InvalidExtendClass
 */
class CTClient
{
    private Client $guzzleClient;
    private static ?CTClient $client = null;

    public function __construct(array $config = [])
    {
        $this->guzzleClient = new Client($config);
    }

    protected static function mergeOptions(array $options): array
    {
        return array_merge_recursive($options, CTConfig::getRequestConfig());
    }

    public function get($uri, array $options = []): ResponseInterface
    {
        try {
            CTLog::getLog()->debug('CTClient: GET-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse($this->guzzleClient->get($uri, self::mergeOptions($options)));
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        try {
            CTLog::getLog()->debug('CTClient: POST-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse($this->guzzleClient->post($uri, self::mergeOptions($options)));
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
        if (isset(self::$client)) {
            return self::$client;
        }
        return new CTClient();
    }

    public static function setClient(CTClient $client): void
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