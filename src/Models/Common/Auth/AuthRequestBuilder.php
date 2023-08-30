<?php

namespace CTApi\Models\Common\Auth;

use CTApi\CTClient;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Groups\Person\Person;
use CTApi\Utils\CTResponseUtil;

class AuthRequestBuilder
{
    public function authWithEmailAndPassword(string $email, string $password): Auth
    {
        $client = CTClient::getClient();

        $response = null;

        try {
            $response = $client->post('/api/login', [
                'json' => [
                    'username' => $email,
                    'password' => $password
                ],
                'headers' => [
                    'Cache-Control' => 'no-cache'
                ]
            ]);
        } catch (CTRequestException $e) {
            throw new CTAuthException(
                "Authentication was not successfully. HTTP Exception occurred.",
                null,
                $e);
        }

        if ($response->getStatusCode() == 200) {
            $jsonResponse = json_decode($response->getBody()->__toString());

            $userId = (isset($jsonResponse->data) ? $jsonResponse->data->personId : null);
            return new Auth($userId, (($jsonResponse->data->status ?? null) === "totp"));
        } else {
            $jsonResponse = json_decode($response->getBody()->__toString());
            if (isset($jsonResponse->message)) {
                throw new CTAuthException("Authentication was not successfully: " . $jsonResponse->message);
            } else {
                throw new CTAuthException("Authentication was not successfully. HTTP Status Code is not 200.");
            }
        }
    }

    public function authWithLoginToken(string $loginToken): Auth
    {
        $client = CTClient::getClient();

        try {
            $response = $client->get('/api/whoami', [
                'headers' => [
                    'authorization' => 'Login ' . $loginToken
                ]
            ]);
            $data = CTResponseUtil::dataAsArray($response);
            $person = Person::createModelFromData($data);
        } catch (CTRequestException $exception) {
            throw new CTAuthException("Authentication was not successfull: " . $exception->getMessage(), $exception->getCode(), $exception);
        }

        if ($person->getId() != null && $person->getId() != -1 && $person->getId() != "-1") {
            return new Auth($person->getId(), false);
        }
        throw new CTAuthException("Authentication was not successfull.");
    }

    public function authWithUserIdAndLoginToken(string $userId, string $loginToken): bool
    {
        $client = CTClient::getClient();
        $response = $client->post('index.php?q=login/ajax', [
            'json' => [
                'func' => 'loginWithToken',
                'id' => $userId,
                'token' => $loginToken
            ],
            'headers' => [
                'Cache-Control' => 'no-cache'
            ]
        ]);
        $data = CTResponseUtil::jsonToArray($response);

        return array_key_exists("status", $data) ? ($data["status"] === "success") : true;
    }

    public function retrieveApiToken(string $userId): ?string
    {
        $client = CTClient::getClient();

        try {
            $response = $client->get(
                '/api/persons/' . $userId . '/logintoken',
                [
                    'headers' => [
                        'Cache-Control' => 'no-cache'
                    ]
                ]
            );
        } catch (CTRequestException $e) {
            throw new CTAuthException(
                "Authentication was not successfully. Could not retrieve login token.",
                null,
                $e
            );
        }

        $responseJson = json_decode($response->getBody()->__toString());
        return (isset($responseJson->data) ? $responseJson->data : null);
    }

    public function authTwoFactorAuthentication(string $personId, string $totp)
    {
        $client = CTClient::getClient();
        $client->post('/api/login/totp', ["json" => ["personId" => $personId, "code" => $totp]]);
    }
}