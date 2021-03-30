<?php


namespace CTApi\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Throwable;

class AuthException extends RuntimeException
{
    #[Pure] public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}