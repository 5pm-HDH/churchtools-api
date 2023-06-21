<?php

namespace CTApi\Test\Integration\Exceptions;

use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Events\Event\EventRequest;
use CTApi\Test\Integration\TestCaseAuthenticated;

class RequestExceptionTest extends TestCaseAuthenticated
{
    public function testModelNotFound(): void
    {
        $this->expectException(CTRequestException::class);
        EventRequest::findOrFail(99999999);
    }
}