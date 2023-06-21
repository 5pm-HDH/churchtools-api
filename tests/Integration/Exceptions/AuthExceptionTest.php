<?php

namespace CTApi\Test\Integration\Exceptions;

use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;
use PHPUnit\Framework\TestCase;

class AuthExceptionTest extends TestCase
{
    protected function setUp(): void
    {
        CTConfig::clearConfig();
    }

    public function testWrongEmail(): void
    {
        $this->expectException(CTAuthException::class);
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
        CTConfig::authWithCredentials("wrong-email@fail.com", "wrongPassword");
    }

    public function testWrongApiKey(): void
    {
        $this->expectException(\CTApi\Exceptions\CTRequestException::class);
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
        CTConfig::setApiKey("wrong-api-key");
        $person = PersonRequest::whoami();
    }
}