<?php

namespace CTApi\Test\Integration\Exceptions;


use CTApi\CTConfig;
use CTApi\Exceptions\CTConnectException;
use CTApi\Models\Groups\Person\PersonRequest;
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