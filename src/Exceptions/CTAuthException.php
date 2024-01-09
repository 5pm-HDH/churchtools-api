<?php

namespace CTApi\Exceptions;

use CTApi\CTLog;
use Throwable;

/**
 * Class CTAuthException is a CTRequestException. It Indicates a failed authentification.
 * @package CTApi\Exceptions
 */
class CTAuthException extends CTRequestException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTAuthException: " . $message);
    }
}
