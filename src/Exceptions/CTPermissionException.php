<?php

namespace CTApi\Exceptions;

use CTApi\CTLog;
use Throwable;

/**
 * Class CTPermissionException is a CTRequestException that indicates a permission error.
 * @package CTApi\Exceptions
 */
class CTPermissionException extends CTRequestException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTPermissionException: " . $message);
    }
}
