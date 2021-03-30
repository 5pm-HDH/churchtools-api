<?php


use CTApi\Requests\AuthRequest;
use PHPUnit\Framework\TestCase;

class AuthApiTest extends TestCase
{

    public function testAuthWithConfig()
    {
        $auth = AuthRequest::authWithConfig();
    }

}