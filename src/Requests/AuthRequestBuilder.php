<?php

namespace CTApi\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\AuthException;
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

        try {
            $response = $client->post('/api/login', [
                'json' => [
                    'username' => $email,
                    'password' => $password
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new AuthException(
                "Authentication was not successfully. HTTP Exception occurred.",
                null,
                $e);
        }

        if ($response->getStatusCode() == 200) {
            $jsonResponse = json_decode($response->getBody());

            $this->userId = (isset($jsonResponse->data) ? $jsonResponse->data->personId : null);

            $this->retrieveLoginToken();
        } else {
            throw new AuthException("Authentication was not successfully. Login returned invalid HTTP-Code.");
        }

        return $this->get();
    }

    private function retrieveLoginToken(): void
    {
        if ($this->userId == null) {
            throw new AuthException("Authentication was not successfully. UserId was not defined.");
        }

        $client = CTClient::getClient();
        try {
            $response = $client->get('/api/persons/' . $this->userId . '/logintoken');
        } catch (GuzzleException $e) {
            throw new AuthException(
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