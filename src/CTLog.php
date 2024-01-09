<?php

namespace CTApi;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class CTLog
{
    private const LOG_FILE = __DIR__ . '/../churchtools-api.log';
    private const LOG_FILE_WARNING = __DIR__ . '/../churchtools-api-warning.log';
    private const LOG_HTTP_DATA_DIR = __DIR__ . '/../http-dump/';

    private static ?Logger $logger = null;
    private static bool $fileLogEnabled = true;
    private static bool $consoleLogEnabled = true;
    private static bool $httpLogEnabled = false;
    private static string $httpLogName = "Log";

    // Log-Level: https://github.com/Seldaek/monolog/blob/main/doc/01-usage.md#log-levels
    private static Level $consoleLogLevel = Level::Error;

    public static function getLog(): Logger
    {
        if (is_null(self::$logger)) {
            self::createLog();
        }
        if (isset(self::$logger)) {
            return self::$logger;
        }
        return new Logger('CTLogger');
    }

    private static function createLog(): void
    {
        self::$logger = new Logger('CTApi');

        if (self::$fileLogEnabled) {
            self::$logger->pushHandler(new StreamHandler(self::LOG_FILE, Level::Info));
            self::$logger->pushHandler(new StreamHandler(self::LOG_FILE_WARNING, Level::Warning));
        }
        if (self::$consoleLogEnabled) {
            self::$logger->pushHandler(new StreamHandler('php://stdout', self::$consoleLogLevel));
        }
    }

    public static function enableFileLog($enabled = true): void
    {
        self::$fileLogEnabled = $enabled;
        self::createLog();
    }

    public static function enableConsoleLog($enabled = true): void
    {
        self::$consoleLogEnabled = $enabled;
        self::createLog();
    }

    public static function enableHttpLog($enabled = true): void
    {
        $deciple = ["Peter", "John", "James", "Andrew", "Philip", "Bartholomew", "Thomas", "Matthew", "James", "Juda", "Simon", "Judas-Iscariot"];
        $index = array_rand($deciple, 1);

        self::$httpLogEnabled = $enabled;
        self::$httpLogName = $deciple[$index] . random_int(100, 1000);
    }

    public static function logHttpData(array $httpData): void
    {
        if(!self::$httpLogEnabled) {
            return;
        }

        if(!file_exists(self::LOG_HTTP_DATA_DIR)) {
            mkdir(self::LOG_HTTP_DATA_DIR);
        }

        $fileName = date("Y-m-d-H-i-s") . "-" . self::$httpLogName . ".json";
        file_put_contents(self::LOG_HTTP_DATA_DIR . $fileName, json_encode($httpData, JSON_PRETTY_PRINT));
    }

    public static function setConsoleLogLevelError(): void
    {
        self::$consoleLogLevel = Level::Error;
        self::createLog();
    }

    public static function setConsoleLogLevelDebug(): void
    {
        self::$consoleLogLevel = Level::Debug;
        self::createLog();
    }
}
