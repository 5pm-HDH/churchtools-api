<?php


namespace CTApi;


use CTApi\Exceptions\CTConnectException;
use CTApi\Exceptions\CTPermissionException;
use CTApi\Exceptions\CTRequestException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
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

    public function patch($uri, array $options = []): ResponseInterface
    {
        try {
            CTLog::getLog()->debug('CTClient: PATCH-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse($this->guzzleClient->patch($uri, self::mergeOptions($options)));
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    public function delete($uri, array $options = []): ResponseInterface
    {
        try {
            CTLog::getLog()->debug('CTClient: DELETE-Request URI:' . $uri, ["options" => $options, "mergedOptions" => self::mergeOptions($options)]);
            return $this->handleResponse($this->guzzleClient->delete($uri, self::mergeOptions($options)));
        } catch (Exception $exception) {
            return $this->handleException($exception);
        }
    }

    private function handleResponse(ResponseInterface $response): ResponseInterface
    {
        $responseCode = (int)$response->getStatusCode();
        if ($responseCode == 401 || $responseCode == 403) {
            throw CTPermissionException::ofErrorResponse($response);
        }

        if ($responseCode >= 200 && $responseCode <= 299) {
            return $response;
        }

        throw CTRequestException::ofErrorResponse($response);
    }

    private function handleException(Exception $exception): ResponseInterface
    {
        if ($exception instanceof ConnectException) {
            throw new CTConnectException($exception->getMessage(), $exception->getCode(), $exception);
        } else if ($exception instanceof GuzzleException) {
            throw new CTRequestException($exception->getMessage(), $exception->getCode(), $exception);
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