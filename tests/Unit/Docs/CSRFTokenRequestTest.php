<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Common\Auth\CSRFTokenRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class CSRFTokenRequestTest extends TestCaseHttpMocked
{

    public function testGetCSRFToken()
    {
        $nullableToken = CSRFTokenRequest::get(); // can be null|string
        $notNullToken = CSRFTokenRequest::getOrFail(); // throws exception if null

        $this->assertEquals("db639402f593da794d99aa2706339314da62a7c0dbcc3bb8c505d82d6702b73e", $notNullToken);
    }

}