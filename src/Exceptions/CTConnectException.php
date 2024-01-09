<?php

namespace CTApi\Exceptions;

use CTApi\CTLog;
use Throwable;

/**
 * Class CTConnectException is a CRRequestException. Its thrown when ChurchTools server is not available.
 * @package CTApi\Exceptions
 */
class CTConnectException extends CTRequestException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        CTLog::getLog()->warning("CTConfigException: " . $message);
    }
}
