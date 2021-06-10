<?php

namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTAuthException;
use CTApi\Models\Auth;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\Pure;

class AuthRequestBuilder
{

    private ?string $userId = null;
    private ?string $apiKey = null;

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
        } catch (GuzzleException $e) {
            throw new CTAuthException(
                "Authentication was not successfully. HTTP Exception occurred.",
                null,
                $e);
        }

        if ($response->getStatusCode() == 200) {
            $jsonResponse = json_decode($response->getBody());

            $this->userId = (isset($jsonResponse->data) ? $jsonResponse->data->personId : null);

            $this->retrieveLoginToken();
        } else {
            $jsonResponse = json_decode($response->getBody());
            if (isset($jsonResponse->message)) {
                throw new CTAuthException("Authentication was not successfully: " . $jsonResponse->message);
            } else {
                throw new CTAuthException("Authentication was not successfully. HTTP Status Code is not 200.");
            }
        }

        return $this->get();
    }

    private function retrieveLoginToken(): void
    {
        if ($this->userId == null) {
            throw new CTAuthException("Authentication was not successfully. UserId is not defined.");
        }

        $client = CTClient::getClient();
        try {
            $response = $client->get(
                '/api/persons/' . $this->userId . '/logintoken',
                [
                    'headers' => [
                        'Cache-Control' => 'no-cache'
                    ]
                ]
            );
        } catch (GuzzleException $e) {
            throw new CTAuthException(
                "Authentication was not successfully. Could not retrieve login token.",
                null,
                $e
            );
        }

        $responseJson = json_decode($response->getBody());
        $this->apiKey = (isset($responseJson->data) ? $responseJson->data : null);
    }

    #[Pure] public function get(): Auth
    {
        return new Auth($this->userId, $this->apiKey);
    }
}