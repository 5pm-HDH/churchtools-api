<?php


namespace CTApi\Utils;


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
        $body = new CTResponseBody([]);
        $this->headers = $headers;
    }

    public static function createFromRequestAndData(RequestInterface $request, array $data): CTResponse
    {
        $response = new CTResponse($request->getHeaders());
        $response->withBody(new CTResponseBody($data));
        return $response;
    }

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

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

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        $this->statusCode = $code;
        $this->statusReasonPhrase = $reasonPhrase;
        return $this;
    }

    public function getReasonPhrase()
    {
        return $this->statusReasonPhrase;
    }
}