<?php

namespace CTApi\Requests;

use CTApi\Models\Auth;


class AuthRequest
{
    public static function authWithEmailAndPassword(string $email, string $password): Auth
    {
        return (new AuthRequestBuilder())->authWithEmailAndPassword($email, $password);
    }
}