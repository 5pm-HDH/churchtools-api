<?php

namespace CTApi\Models\Common\Auth;

use CTApi\CTLog;

class AuthRequest
{
    public static function authWithEmailAndPassword(string $email, string $password): Auth
    {
        CTLog::getLog()->info('AuthRequest: Authenticate CTConfig with credentials.');
        return (new AuthRequestBuilder())->authWithEmailAndPassword($email, $password);
    }

    public static function authWithLoginToken(string $loginToken): Auth
    {
        CTLog::getLog()->info('AuthRequest: Authenticate CTConfig with Token');
        return (new AuthRequestBuilder())->authWithLoginToken($loginToken);
    }

    public static function authWithSessionCookie(string $sessionCookie): Auth
    {
        CTLog::getLog()->info('AuthRequest: Authenticate CTConfig with Session');
        return (new AuthRequestBuilder())->authWithSessionCookie($sessionCookie);
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
