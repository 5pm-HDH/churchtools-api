<?php

namespace CTApi\Models\Common\Auth;

class Auth
{
    function __construct(
        public $userId,
        public bool $requireMultiFactorAuthentication = false
    )
    {

    }

}