<?php

namespace Tests\Unit\HttpMock;

use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Utils\CTCacheResponse;
use CTApi\Utils\CTMessageBody;
use CTApi\Utils\CTResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class CTClientMock extends CTClient
{

    private array $requestCalls = [];
    private array $responses = [];

    public function get($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("GET", $uri, $options);
        return $this->addResponse($this->convertGETRequestToResponse($uri, $options));
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("POST", $uri, $options);
        return $this->addResponse($this->convertPOSTRequestToResponse($uri, $options));
    }

    public function patch($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("PATCH", $uri, $options);
        return CTResponse::createEmpty();
    }

    public function delete($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("DELETE", $uri, $options);
        return CTResponse::createEmpty();
    }

    protected function convertGETRequestToResponse($uri, $options): ResponseInterface
    {
        $responseData = HttpMockDataResolver::resolveEndpoint($uri, $options);

        $ctResponse = CTResponse::createEmpty();
        $ctResponse->withBody(new CTMessageBody($responseData));

        return $ctResponse;
    }

    protected function convertPOSTRequestToResponse($uri, $options): ResponseInterface
    {
        $responseData = HttpMockDataResolver::resolveEndpoint($uri, $options);

        $ctResponse = CTResponse::createEmpty();
        $ctResponse->withBody(new CTMessageBody($responseData));

        return $ctResponse;
    }

    public function resetState(): void
    {
        CTLog::getLog()->debug("CTClientMock: Reset state of CTClientMock-Object");
        $this->clearAllRequestCalls();
        $this->clearResponses();
    }

    private function addResponse(ResponseInterface $response): ResponseInterface
    {
        array_push($this->responses, $response);
        return $response;
    }

    public function getResponses(): array
    {
        return $this->responses;
    }

    public function clearResponses(): void
    {
        $this->responses = [];
    }

    public function assertOnlyCacheResponse(): void
    {
        $onlyCacheResponse = true;

        foreach ($this->responses as $response) {
            if (!$response instanceof CTCacheResponse) {
                $onlyCacheResponse = false;
            }
        }
        TestCase::assertTrue($onlyCacheResponse, "None-Cache Response found!");
    }

    public function assertOnlyNoneCacheResponse(): void
    {
        $onlyNoneCacheResponse = true;

        foreach ($this->responses as $response) {
            if ($response instanceof CTCacheResponse) {
                $onlyNoneCacheResponse = false;
            }
        }
        TestCase::assertTrue($onlyNoneCacheResponse, "Cache-Response found!");
    }


    private function addMethodCall($method, $uri, $options): void
    {
        array_push($this->requestCalls, [
            'method' => $method,
            'uri' => $uri,
            'options' => $options
        ]);
    }

    public function assertRequestCallExists(string $method, $uri = null): array
    {
        $request = $this->filterAllRequests($method, $uri);
        TestCase::assertTrue(sizeof($request) > 0, "No Requests send with Method " . $method . " and Uri " . $uri);
        return end($request);
    }

    public function assertRequestCallNotExists(string $method, $uri = null): void
    {
        TestCase::assertTrue(sizeof($this->filterAllRequests($method, $uri)) == 0, "Requests found with Method " . $method . " and Uri " . $uri);
    }

    public function filterAllRequests(string $method, $uri = null): array
    {
        return array_filter($this->getAllRequestCalls(), function ($requestCall) use ($method, $uri) {
            if ($uri != null) {
                return $requestCall['method'] == $method && $requestCall['uri'] == $uri;
            } else {
                return $requestCall['method'] == $method;
            }
        });
    }

    public function getAllRequestCalls(): array
    {
        return $this->requestCalls;
    }

    public function clearAllRequestCalls(): void
    {
        $this->requestCalls = [];
    }

}