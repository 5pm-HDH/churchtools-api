<?php

namespace CTApi;

use CTApi\Requests\AuthRequest;
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
            "cookies" => new CookieJar()
        ];
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
        self::setRequestOption('login_token', $auth->apiKey);
    }

    public static function getApiKey(): ?string
    {
        return self::getRequestOption('login_token');
    }

    private static function setRequestOption(string $key, $value)
    {
        self::getConfig()->requestOptions[$key] = $value;
    }

    private static function getRequestOption(string $key)
    {
        return isset(self::getConfig()->requestOptions[$key]) ? self::getConfig()->requestOptions[$key] : null;
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