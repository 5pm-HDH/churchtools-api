<?php

namespace CTApi\Utils;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CTResponse implements ResponseInterface
{
    private string $protocolVersion = "1.1";
    private array $headers = [];
    private StreamInterface $body;
    private int $statusCode = 200;
    private string $statusReasonPhrase = "OK";

    public function __construct($headers = [])
    {
        $body = new CTMessageBody([]);
        $this->headers = $headers;
    }

    public static function createFromRequestAndData(RequestInterface $request, array $data): CTResponse
    {
        $response = new CTResponse($request->getHeaders());
        $response->withBody(new CTMessageBody($data));
        return $response;
    }

    public static function createEmpty(): CTResponse
    {
        $response = new CTResponse([]);
        $response->withBody(new CTMessageBody([]));
        return $response;
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version): MessageInterface
    {
        $this->protocolVersion = $version;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader($name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    public function getHeader($name): array
    {
        return ($this->hasHeader($name) ? $this->headers[$name] : []);
    }

    public function getHeaderLine($name): string
    {
        if ($this->hasHeader($name)) {
            return implode(',', $this->getHeader($name));
        } else {
            return "";
        }
    }

    public function withHeader($name, $value): MessageInterface
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        if ($this->hasHeader($name)) {
            $this->headers[$name] = array_merge($this->getHeader($name), $value);
        } else {
            $this->headers[$name] = $value;
        }
        return $this;
    }

    public function withAddedHeader($name, $value): MessageInterface
    {
        return $this->withHeader($name, $value);
    }

    public function withoutHeader($name): MessageInterface
    {
        if (array_key_exists($name, $this->headers)) {
            unset($this->headers[$name]);
        }
        return $this;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        $this->body = $body;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        $this->statusCode = $code;
        $this->statusReasonPhrase = $reasonPhrase;
        return $this;
    }

    public function getReasonPhrase(): string
    {
        return $this->statusReasonPhrase;
    }
}
