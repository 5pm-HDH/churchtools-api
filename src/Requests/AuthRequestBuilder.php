<?php

namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Auth;

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
            return new Auth($userId);
        } else {
            $jsonResponse = json_decode($response->getBody()->__toString());
            if (isset($jsonResponse->message)) {
                throw new CTAuthException("Authentication was not successfully: " . $jsonResponse->message);
            } else {
                throw new CTAuthException("Authentication was not successfully. HTTP Status Code is not 200.");
            }
        }
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
}