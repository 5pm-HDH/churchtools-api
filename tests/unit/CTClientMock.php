<?php


use CTApi\CTClient;
use CTApi\CTLog;
use CTApi\Utils\CTCacheResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

abstract class CTClientMock extends CTClient
{

    private array $requestCalls = [];
    private array $responses = [];

    public function get($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("GET", $uri, $options);
        parent::get($uri, $options);

        return $this->addResponse($this->convertGETRequestToResponse($uri, $options));
    }

    public function post($uri, array $options = []): ResponseInterface
    {
        $this->addMethodCall("POST", $uri, $options);
        parent::post($uri, $options);

        return $this->addResponse($this->convertPOSTRequestToResponse($uri, $options));
    }

    abstract protected function convertGETRequestToResponse($uri, $options): ResponseInterface;

    abstract protected function convertPOSTRequestToResponse($uri, $options): ResponseInterface;

    public function resetState()
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

    public function clearResponses()
    {
        $this->responses = [];
    }

    public function assertOnlyCacheResponse()
    {
        $onlyCacheResponse = true;

        foreach ($this->responses as $response) {
            if (!$response instanceof CTCacheResponse) {
                $onlyCacheResponse = false;
            }
        }
        TestCase::assertTrue($onlyCacheResponse, "None-Cache Response found!");
    }

    public function assertOnlyNoneCacheResponse()
    {
        $onlyNoneCacheResponse = true;

        foreach ($this->responses as $response) {
            if ($response instanceof CTCacheResponse) {
                $onlyNoneCacheResponse = false;
            }
        }
        TestCase::assertTrue($onlyNoneCacheResponse, "Cache-Response found!");
    }


    private function addMethodCall($method, $uri, $options)
    {
        array_push($this->requestCalls, [
            'method' => $method,
            'uri' => $uri,
            'options' => $options
        ]);
    }

    public function assertRequestCallExists(string $method, $uri = null)
    {
        TestCase::assertTrue(sizeof($this->filterAllRequests($method, $uri)) > 0, "No Requests send with Method " . $method . " and Uri " . $uri);
    }

    public function assertRequestCallNotExists(string $method, $uri = null)
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

    public function clearAllRequestCalls()
    {
        $this->requestCalls = [];
    }

}