<?php


namespace CTApi\Exceptions;


use CTApi\CTLog;
use RuntimeException;
use Throwable;

class CTModelException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTModelException: " . $message);
    }
}