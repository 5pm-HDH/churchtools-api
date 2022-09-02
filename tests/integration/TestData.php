<?php

namespace Tests\Integration;

class TestData
{

    private static string $FILE_PATH = __DIR__ . '/testdata.ini';

    private static ?array $fileContent = null;

    public static function getValue(string $key): string
    {
        if (self::$fileContent == null) {
            self::$fileContent = parse_ini_file(self::$FILE_PATH);
        }


        if (is_array(self::$fileContent) && array_key_exists($key, self::$fileContent)) {
            return self::$fileContent[$key];
        } else {
            return "";
        }
    }

    public static function getValueAsBool(string $key): bool
    {
        $value = self::getValue($key);
        if ($value == "true" || $value == "1") {
            return true;
        } else if ($value == "false" || $value == "0" || $value == "") {
            return false;
        }
        throw new \InvalidArgumentException("TestData for value " . $key . " is invalid. Bool value excepted.");
    }
}