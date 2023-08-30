<?php

namespace CTApi\Test\Unit\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Traits\Request\WhereCondition;
use PHPUnit\Framework\TestCase;

class WhereConditionTest extends TestCase
{

    public function testNoDoubleWhereClauses(): void
    {
        $exampleRequest = new ExampleRequest();

        $this->expectException(CTRequestException::class);
        $exampleRequest->where('ids', [21, 32, 42])->where('ids', [29, 92]);
    }
}

class ExampleRequest
{
    use WhereCondition;
}