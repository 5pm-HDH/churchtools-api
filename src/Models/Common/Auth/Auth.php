<?php

namespace CTApi\Models\Common\Auth;

class Auth
{
    public function __construct(
        public $userId,
        public bool $requireMultiFactorAuthentication = false
    ) {

    }

}
