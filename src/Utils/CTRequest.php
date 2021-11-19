<?php


namespace CTApi\Utils;


use GuzzleHttp\Psr7\Uri;
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

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * @psalm-suppress InvalidReturnType
     */
    public function withProtocolVersion($version)
    {
        $this->protocolVersion = $version;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        return array_key_exists($name, $this->headers);
    }

    public function getHeader($name)
    {
        return ($this->hasHeader($name) ? $this->headers[$name] : []);
    }

    public function getHeaderLine($name)
    {
        if ($this->hasHeader($name)) {
            return implode(',', $this->getHeader($name));
        } else {
            return "";
        }
    }

    public function withHeader($name, $value)
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

    public function withAddedHeader($name, $value)
    {
        return $this->withHeader($name, $value);
    }

    public function withoutHeader($name)
    {
        if (array_key_exists($name, $this->headers)) {
            unset($this->headers[$name]);
        }
        return $this;
    }


    public function getBody()
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        $this->body = $body;
        return $this;
    }


    public function getRequestTarget()
    {
        return "";
    }

    public function withRequestTarget($requestTarget)
    {
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function withMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $this->uri = $uri;
        return $this;
    }
}