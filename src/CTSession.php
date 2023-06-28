<?php


namespace CTApi;


class CTSession
{
    private const DEFAULT_SESSION_ID = "default";

    private static array $ctConfigs = [];
    private static array $ctClients = [];

    public static function switchSession(string $sessionId = self::DEFAULT_SESSION_ID)
    {
        self::storeDefaultSessionIfNotExists();
        if (!self::sessionExists($sessionId)) {
            self::createSession($sessionId);
        } else {
            self::switchToSession($sessionId);
        }
    }

    private static function storeDefaultSessionIfNotExists()
    {
        if (!self::sessionExists(self::DEFAULT_SESSION_ID)) {
            self::$ctConfigs[self::DEFAULT_SESSION_ID] = CTConfig::getConfig();
            self::$ctClients[self::DEFAULT_SESSION_ID] = CTClient::getClient();
        }
    }

    private static function sessionExists(string $sessionId)
    {
        return array_key_exists($sessionId, self::$ctConfigs) && array_key_exists($sessionId, self::$ctClients);
    }

    private static function createSession(string $sessionId)
    {
        $config = CTConfig::createConfig();
        $client = CTClient::createClient();

        self::$ctConfigs[$sessionId] = $config;
        self::$ctClients[$sessionId] = $client;

        self::switchToSession($sessionId);
    }

    private static function switchToSession(string $sessionId)
    {
        CTConfig::setConfig(self::$ctConfigs[$sessionId]);
        CTClient::setClient(self::$ctClients[$sessionId]);
    }

    public static function getSessionIds(): array
    {
        self::storeDefaultSessionIfNotExists();
        $keysConfig = array_keys(self::$ctConfigs);
        $keysClient = array_keys(self::$ctConfigs);
        return array_intersect($keysConfig, $keysClient);
    }

    public static function clearSessions()
    {
        self::$ctClients = [];
        self::$ctConfigs = [];
    }
}