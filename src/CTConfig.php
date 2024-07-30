<?php

namespace CTApi;

use CTApi\Exceptions\CTConfigException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Middleware\CTCacheMiddleware;
use CTApi\Models\Common\Auth\Auth;
use CTApi\Models\Common\Auth\AuthRequest;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Utils\CTUtil;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
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

    private CookieJar $cookieJar;

    /**
     * RequestOptions of Guzzle (https://docs.guzzlephp.org/en/stable/request-options.html)
     * @var array with requestOptions
     */
    private array $requestOptions;

    private ?int $paginationPageSize = null;

    private function __construct()
    {
        $this->cookieJar = new CookieJar();

        //set default value for guzzle request
        $this->requestOptions = [
            "cookies" => $this->cookieJar,   //enable cookie storage
            "http_errors" => false,          //disable Exceptions on 4xx & 5xx http-response
            "headers" => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'ChurchTools-API Client (5pm-hdh/churchtools-api)',
            ]
        ];
    }

    public static function clearConfig(): void
    {
        self::$config = CTConfig::createConfig();
    }

    public static function createConfig(): CTConfig
    {
        return new CTConfig();
    }

    public static function clearCookies(): void
    {
        $config = self::getConfig();
        $newCookieJar = new CookieJar();
        $config->cookieJar = $newCookieJar;
        self::setRequestOption("cookies", $newCookieJar);
    }

    public static function getConfig(): CTConfig
    {
        if (is_null(self::$config)) {
            self::$config = CTConfig::createConfig();
        }
        return self::$config;
    }

    public static function setConfig(CTConfig $config)
    {
        self::$config = $config;
    }

    private static function setRequestOption(string $path, $value): void
    {
        CTUtil::arrayPathSet(self::getConfig()->requestOptions, $path, $value);
    }

    public static function getRequestConfig(): array
    {
        self::validateConfig();
        return self::getConfig()->requestOptions;
    }

    public static function validateConfig(): void
    {
        $apiUrl = self::getRequestOption('base_uri');
        if ($apiUrl == null) {
            throw new CTConfigException("CTConfig invalid: ApiUrl cannot be null. Set it with: CTConfig::setApiUrl('https://example.com')");
        }
    }

    private static function getRequestOption(string $path)
    {
        $array = self::getConfig()->requestOptions;
        return CTUtil::arrayPathGet($array, $path);
    }

    public static function setApiUrl(string $apiUrl): void
    {
        self::setRequestOption("base_uri", $apiUrl);
    }

    public static function getApiUrl(): ?string
    {
        return self::getRequestOption("base_uri");
    }

    public static function authWithCredentials(string $email, string $password, ?string $totp = null): Auth
    {
        $auth = AuthRequest::authWithEmailAndPassword($email, $password);
        if ($auth->requireMultiFactorAuthentication) {
            if ($totp == null) {
                throw new CTConfigException("Authentication for given user requires TOPT-Code for multi-factor authentication.");
            } else {
                AuthRequest::authTwoFactorAuthentication($auth->userId, $totp);
            }
        }
        return $auth;
    }

    public static function authWithLoginToken(string $loginToken): Auth
    {
        return AuthRequest::authWithLoginToken($loginToken);
    }

    public static function authWithSessionCookie(string $cookieString): Auth
    {
        return AuthRequest::authWithSessionCookie($cookieString);
    }

    /**
     * Auth via undocumented ajax-API. Use <code>authWithLoginToken()</code> instead.
     * @param string $userId
     * @param string $loginToken
     * @return bool
     * @deprecated Will be removed in further versions.
     * @see CTConfig::authWithLoginToken() Authenticate via REST-API.
     */
    public static function authWithUserIdAndLoginToken(string $userId, string $loginToken): bool
    {
        return AuthRequest::authWithUserIdAndLoginToken($userId, $loginToken);
    }

    public static function getSessionCookie(): ?array
    {
        $config = self::getConfig();
        $cookieData = $config->cookieJar->toArray();
        if (empty($cookieData)) {
            return null;
        }
        return array_pop($cookieData);
    }

    public static function getSessionCookieString(): ?string
    {
        $cookieData = self::getSessionCookie();
        return $cookieData ? (string) (new SetCookie($cookieData)) : null;
    }

    /**
     * @see CTConfig::authWithLoginToken()
     * @deprecated Will be removed in further version. Use <code>CTConfig::authWithLoginToken()</code> instead.
     */
    public static function setApiKey(string $apiKey): void
    {
        self::setRequestOption(self::PATH_LOGIN_TOKEN, $apiKey);
    }

    /**
     * @see AuthRequest::retrieveApiToken()
     * @deprecated Will be removed in further version. Use <code>AuthRequest::retrieveApiToken()</code> instead.
     */
    public static function getApiKey(): ?string
    {
        return self::getRequestOption(self::PATH_LOGIN_TOKEN);
    }

    public static function setPaginationPageSize(int $pageSize): void
    {
        self::getConfig()->paginationPageSize = $pageSize;
    }

    public static function getPaginationPageSize(): ?int
    {
        $config = self::getConfig();
        $size = $config->paginationPageSize;
        return $size;
    }

    public static function validateAuthentication(): bool
    {
        try {
            $ctUser = PersonRequest::whoami();
            if ($ctUser->getId() == -1 || $ctUser->getId() == null) {
                return false;
            } else {
                return true;
            }
        } catch (CTRequestException $exception) {
            return false;
        }
    }

    public static function enableDebugging(): void
    {
        CTLog::setConsoleLogLevelDebug();
        self::setRequestOption('on_stats', function (TransferStats $stats) {

            CTLog::getLog()->debug('TransferStats: EffectiveUri: ' . $stats->getEffectiveUri());
            CTLog::getLog()->debug('TransferStats: TransferTime: ' . $stats->getTransferTime());
            CTLog::getLog()->debug('TransferStats: Request Method: ' . $stats->getRequest()->getMethod());

            if ($stats->hasResponse()) {
                CTLog::getLog()->debug('TransferStats: StatusCode: ' . $stats->getResponse()?->getStatusCode());
            } else {
                CTLog::getLog()->debug('TransferStats: ErrorData: ' . var_export($stats->getHandlerErrorData(), true));
            }
        });
    }

    public static function disableDebugging(): void
    {
        CTLog::setConsoleLogLevelError();
        self::setRequestOption('on_stats', null);
    }

    public static function enableCache(?int $timeToLive = null): void
    {
        $stack = HandlerStack::create();

        if (!is_null($timeToLive)) {
            CTCacheMiddleware::setTimeToLive($timeToLive);
        }

        $stack->push(CTCacheMiddleware::create());

        CTLog::getLog()->info("CTConfig: Create cache-middleware and recreate CTClient");
        $client = CTClient::createClient($stack);
        CTClient::setClient($client);
    }

    public static function disableCache(): void
    {
        CTLog::getLog()->info("CTConfig: Recreate CTClient without cache-middleware");
        $client = CTClient::createClient();
        CTClient::setClient($client);
    }

    public static function clearCache(): void
    {
        CTLog::getLog()->info("CTConfig: Clear cache.");
        CTCacheMiddleware::getCacheDriver()->deleteAll();
        CTCacheMiddleware::getCacheDriver()->flushAll();
    }
}
