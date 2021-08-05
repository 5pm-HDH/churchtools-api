<?php

namespace CTApi;

use CTApi\Exceptions\CTConfigException;
use CTApi\Middleware\CTCacheMiddleware;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\PersonRequest;
use CTApi\Utils\CTUtil;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\TransferStats;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
use Kevinrob\GuzzleCache\Storage\FlysystemStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use League\Flysystem\Adapter\Local;

class CTConfig
{
    private const PATH_LOGIN_TOKEN = 'query.login_token';

    private static ?CTConfig $config = null;
    private static string $cacheDir = __DIR__ . '/../cache/';

    /**
     * RequestOptions of Guzzle (https://docs.guzzlephp.org/en/stable/request-options.html)
     * @var array with requestOptions
     */
    private array $requestOptions;

    private function __construct()
    {
        //set default value for guzzle request
        $this->requestOptions = [
            "cookies" => new CookieJar(),   //enable cookie storage
            "http_errors" => false,          //disable Exceptions on 4xx & 5xx http-response
            "headers" => [
                'Content-Type' => 'application/json'
            ]
        ];
    }

    public static function clearConfig(): void
    {
        self::$config = new CTConfig();
    }

    public static function clearCookies(): void
    {
        self::setRequestOption("cookies", new CookieJar());
    }

    public static function getConfig(): CTConfig
    {
        if (is_null(self::$config)) {
            self::$config = new CTConfig();
        }
        return self::$config;
    }

    public static function getRequestConfig(): array
    {
        self::validateConfig();
        return self::getConfig()->requestOptions;
    }

    public static function setApiUrl(string $apiUrl)
    {
        self::setRequestOption("base_uri", $apiUrl);
    }

    public static function getApiUrl(): ?string
    {
        return self::getRequestOption("base_uri");
    }

    public static function authWithCredentials(string $email, string $password)
    {
        $auth = AuthRequest::authWithEmailAndPassword($email, $password);
        self::setRequestOption(self::PATH_LOGIN_TOKEN, $auth->apiKey);
    }

    public static function setApiKey(string $apiKey)
    {
        self::setRequestOption(self::PATH_LOGIN_TOKEN, $apiKey);
    }

    public static function getApiKey(): ?string
    {
        return self::getRequestOption(self::PATH_LOGIN_TOKEN);
    }

    public static function validateConfig()
    {
        $apiUrl = self::getRequestOption('base_uri');
        if ($apiUrl == null) {
            throw new CTConfigException("CTConfig invalid: ApiUrl cannot be null. Set it with: CTConfig::setApiUrl('https://example.com/api')");
        }
    }

    public static function validateApiKey(): bool
    {
        $ctUser = PersonRequest::whoami();
        if ($ctUser->getId() == -1 || $ctUser->getId() == null) {
            return false;
        } else {
            return true;
        }
    }

    private static function setRequestOption(string $path, $value)
    {
        CTUtil::arrayPathSet(self::getConfig()->requestOptions, $path, $value);
    }

    private static function getRequestOption(string $path)
    {
        $array = self::getConfig()->requestOptions;
        return CTUtil::arrayPathGet($array, $path);
    }

    public static function enableDebugging()
    {
        CTLog::setConsoleLogLevelDebug();
        self::setRequestOption('on_stats', function (TransferStats $stats) {

            CTLog::getLog()->debug('TransferStats: EffectiveUri: ' . $stats->getEffectiveUri());
            CTLog::getLog()->debug('TransferStats: TransferTime: ' . $stats->getTransferTime());
            CTLog::getLog()->debug('TransferStats: Request Method: ' . $stats->getRequest()->getMethod());

            if ($stats->hasResponse()) {
                CTLog::getLog()->debug('TransferStats: StatusCode: ' . $stats->getResponse()->getStatusCode());
            } else {
                CTLog::getLog()->debug('TransferStats: ErrorData: ' . var_export($stats->getHandlerErrorData(), true));
            }
        });
    }

    public static function disableDebugging()
    {
        CTLog::setConsoleLogLevelError();
        self::setRequestOption('on_stats', null);
    }

    public static function enableCache(?int $timeToLive = null)
    {
        $stack = HandlerStack::create();

        if (!is_null($timeToLive)) {
            CTCacheMiddleware::setTimeToLive($timeToLive);
        }

        $stack->push(CTCacheMiddleware::create());

        CTLog::getLog()->info("CTConfig: Create cache-middleware and recreate CTClient");
        CTClient::createClient($stack);
    }

    public static function disableCache()
    {
        CTLog::getLog()->info("CTConfig: Recreate CTClient without cache-middleware");
        CTClient::createClient();
    }

    public static function clearCache()
    {
        CTLog::getLog()->info("CTConfig: Clear cache.");
        CTCacheMiddleware::getCacheDriver()->deleteAll();
        CTCacheMiddleware::getCacheDriver()->flushAll();
    }
}