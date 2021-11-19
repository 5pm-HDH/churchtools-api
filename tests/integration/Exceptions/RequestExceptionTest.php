<?php

use CTApi\Exceptions\CTRequestException;
use CTApi\Requests\EventRequest;
use Tests\Integration\TestCaseAuthenticated;

class RequestExceptionTest extends TestCaseAuthenticated
{
    public function testModelNotFound(): void
    {
        $this->expectException(CTRequestException::class);
        EventRequest::findOrFail(99999999);
    }
}