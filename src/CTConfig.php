<?php

namespace CTApi;

use CTApi\Exceptions\CTConfigException;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\PersonRequest;
use CTApi\Utils\CTUtil;
use GuzzleHttp\Cookie\CookieJar;

class CTConfig
{
    private static ?CTConfig $config = null;

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
        self::setRequestOption('query.login_token', $auth->apiKey);
    }

    public static function setApiKey(string $apiKey)
    {
        self::setRequestOption('query.login_token', $apiKey);
    }

    public static function getApiKey(): ?string
    {
        return self::getRequestOption('query.login_token');
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
        self::setRequestOption("debug", true);
    }

    public static function disableDebugging()
    {
        self::setRequestOption("debug", false);
    }

}