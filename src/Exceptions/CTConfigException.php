<?php


namespace CTApi\Exceptions;


use CTApi\CTLog;
use RuntimeException;
use Throwable;

/**
 * Class CTConfigException indicates a error in the CTConfig-Settings.
 * @package CTApi\Exceptions
 */
class CTConfigException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTConfigException: " . $message);
    }
}