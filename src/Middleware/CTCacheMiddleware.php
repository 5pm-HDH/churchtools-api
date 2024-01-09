<?php

namespace CTApi\Middleware;

use CTApi\CTLog;
use CTApi\Utils\CTCacheResponse;
use CTApi\Utils\CTResponseUtil;
use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\Promise\Promise;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CTCacheMiddleware
{
    private static ?CTCacheMiddleware $instance = null;
    private static ?CacheProvider $cacheDriver = null;
    private static string $cacheDir = __DIR__ . '/../../cache/';
    private static int $timeToLive = 1800; //30 min

    public function fetchResponseFromCache(RequestInterface $request): ?CTCacheResponse
    {
        if ($request->getMethod() == "GET" && !$this->cacheIsDisabledInHeader($request)) {
            $cacheId = $this->createCacheIdFromRequest($request);

            if (self::getCacheDriver()->contains($cacheId)) {
                CTLog::getLog()->debug("CTCacheMiddleware: Fetch response from cache.");
                $cacheData = self::getCacheDriver()->fetch($cacheId);

                $currentTime = time();
                $timeTillExpiring = $currentTime - $cacheData['expires'];

                if ($timeTillExpiring < 0) {
                    CTLog::getLog()->debug("CTCacheMiddleware: Cache data is not expired. Prevent HTTP-Request and return cache-data.");
                    return CTCacheResponse::createFromRequestAndData($request, $cacheData['data']);
                } else {
                    CTLog::getLog()->debug("CTCacheMiddleware: Cache data expired.");
                }

            } else {
                CTLog::getLog()->debug("CTCacheMiddleware: Cache does not contains data with given cache id");
            }
        }
        return null;
    }

    public function saveResponseToCache(?string $cacheId, ResponseInterface $response): void
    {
        if (!is_null($cacheId) && !($response instanceof CTCacheResponse) && !$this->cacheIsDisabledInHeader($response)) {
            CTLog::getLog()->debug("CTCacheMiddleware: Save response to cache.");

            $cacheContent = [
                'data' => CTResponseUtil::jsonToArray($response),
                'expires' => time() + self::getTimeToLive()
            ];
            self::getCacheDriver()->save($cacheId, $cacheContent);
        } else {
            CTLog::getLog()->debug("CTCacheMiddleware: Could not store response.");
        }
    }

    private function cacheIsDisabledInHeader(MessageInterface $message): bool
    {
        $noCacheValues = array_filter($message->getHeader('Cache-Control'), function ($value) {
            return $value == "no-cache";
        });

        return sizeof($noCacheValues) > 0;
    }

    public function createCacheIdFromRequest(RequestInterface $request): string
    {
        $cacheId = $request->getUri() . (string)$request->getBody();
        $cacheId = preg_replace('/[^A-Za-z0-9\-]/', '', $cacheId);

        return $cacheId;
    }

    public static function getInstance(): CTCacheMiddleware
    {
        if (is_null(self::$instance)) {
            self::$instance = new CTCacheMiddleware();
        }
        return self::$instance;
    }

    public static function getTimeToLive(): int
    {
        return self::$timeToLive;
    }

    public static function setTimeToLive(int $timeToLive): void
    {
        self::$timeToLive = $timeToLive;
    }

    public static function getCacheDriver(): CacheProvider
    {
        if (is_null(self::$cacheDriver)) {
            self::$cacheDriver = new FilesystemCache(self::$cacheDir);
        }
        return self::$cacheDriver;
    }

    public static function setCacheDriver(CacheProvider $cacheProvider): void
    {
        self::$cacheDriver = $cacheProvider;
    }

    /**
     * @psalm-return \Closure(callable):\Closure(RequestInterface, array):(\GuzzleHttp\Promise\PromiseInterface|mixed)
     */
    public static function create(): \Closure
    {
        $middleware = CTCacheMiddleware::getInstance();
        return function (callable $handler) use ($middleware) {
            return function (
                RequestInterface $request,
                array $options
            ) use ($handler, $middleware) {

                $response = $middleware->fetchResponseFromCache($request);
                $cacheId = null;

                if ($response == null) {
                    $cacheId = $middleware->createCacheIdFromRequest($request);
                    $promise = $handler($request, $options);
                } else {
                    $promise = new Promise();
                    $promise->resolve($response);
                }

                return $promise->then(
                    function (ResponseInterface $response) use ($cacheId, $middleware) {
                        $middleware->saveResponseToCache($cacheId, $response);

                        return $response;
                    }
                );
            };
        };
    }
}
