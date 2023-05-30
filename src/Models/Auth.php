<?php

namespace CTApi\Models;

class Auth
{
    function __construct(
        public $userId,
        public bool $requireMultiFactorAuthentication = false
    )
    {

    }

}