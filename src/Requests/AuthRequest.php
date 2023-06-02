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

    public static function authWithUserIdAndLoginToken(string $userId, string $loginToken): bool
    {
        CTLog::getLog()->info('AuthRequest: Authenticate CTConfig with UserId and Token.');
        return (new AuthRequestBuilder())->authWithUserIdAndLoginToken($userId, $loginToken);
    }

    public static function authTwoFactorAuthentication(string $personId, string $totp)
    {
        CTLog::getLog()->info('AuthRequest: TwoFactorAuthentication.');
        return (new AuthRequestBuilder())->authTwoFactorAuthentication($personId, $totp);
    }

    public static function retrieveApiToken(string $userId): ?string
    {
        CTLog::getLog()->info('AuthRequest: Request API-Token.');
        return (new AuthRequestBuilder())->retrieveApiToken($userId);
    }
}