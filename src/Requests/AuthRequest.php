<?php

namespace CTApi\Requests;

use CTApi\CTLog;
use CTApi\Models\Auth;


class AuthRequest
{
    public static function authWithEmailAndPassword(string $email, string $password): Auth
    {
        CTLog::getLog()->info('AuthRequest: Authenticate CTConfig with credentials.');
        return (new AuthRequestBuilder())->authWithEmailAndPassword($email, $password);
    }

    public static function retrieveApiToken(string $userId): ?string
    {
        CTLog::getLog()->info('AuthRequest: Request API-Token.');
        return (new AuthRequestBuilder())->retrieveApiToken($userId);
    }

    public static function authTwoFactorAuthentication(string $personId, string $totp)
    {
        return (new AuthRequestBuilder())->authTwoFactorAuthentication($personId, $totp);
    }
}