<?php

namespace CTApi\Utils;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class CTRequest implements RequestInterface
{
    private string $protocolVersion = "1.1";
    private array $headers = [];
    private StreamInterface $body;
    private string $method = "GET";
    private UriInterface $uri;

    public function __construct()
    {
        $this->uri = new Uri("https://intern.church.tools/");
        $this->body = new CTMessageBody([]);
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


    public function getRequestTarget(): string
    {
        return "";
    }

    public function withRequestTarget($requestTarget): RequestInterface
    {
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withMethod($method): RequestInterface
    {
        $this->method = $method;
        return $this;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false): RequestInterface
    {
        $this->uri = $uri;
        return $this;
    }
}
