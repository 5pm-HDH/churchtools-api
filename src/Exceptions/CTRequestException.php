<?php


namespace CTApi\Exceptions;


use CTApi\CTLog;
use RuntimeException;
use Throwable;

class CTRequestException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTRequestException: " . $message);
    }

    public static function ofModelNotFound(?string $modelName = null, ?Throwable $throwable = null)
    {
        if (is_null($modelName)) {
            return new CTRequestException("Could not retrieve Model", 0, $throwable);
        } else {
            return new CTRequestException("Could not retrieve Model: " . $modelName, 0, $throwable);
        }
    }
}