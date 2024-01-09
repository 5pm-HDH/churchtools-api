<?php

namespace CTApi\Utils;

class CTDateTimeService
{
    private static array $churchToolsDateFormats = [
        "Y-m-d\TH:i:s\Z",
        "Y-m-d\TH:i:s.000000\Z",
        "Y-m-d H:i:s",
    ];

    public static function stringToDateTime(?string $dateTime, bool $strictFormat = false): ?\DateTimeImmutable
    {
        if($dateTime == null) {
            return null;
        }

        $date = null;

        foreach(self::$churchToolsDateFormats as $dateFormat) {
            $dateOrFalse = \DateTimeImmutable::createFromFormat($dateFormat, $dateTime);
            if($dateOrFalse != false) {
                $date = $dateOrFalse;
                continue;
            }
        }

        if($date == null && $strictFormat == false) {
            $unixTimestamp = strtotime($dateTime);
            if($unixTimestamp == false) {
                return null;
            }

            $date = new \DateTimeImmutable();
            $date = $date->setTimestamp($unixTimestamp);
        }
        return $date;
    }
}
