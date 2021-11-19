<?php


use CTApi\CTConfig;
use CTApi\Exceptions\CTConnectException;
use CTApi\Requests\PersonRequest;
use PHPUnit\Framework\TestCase;

class ConnectExceptionTest extends TestCase
{
    protected function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testApiUrlInvalidServer(): void
    {
        $this->expectException(CTConnectException::class);
        CTConfig::setApiUrl("http://novalidsubdomain.lukasdumberger.de/");
        PersonRequest::whoami();
    }
}