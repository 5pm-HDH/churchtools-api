<?php


use CTApi\CTConfig;
use CTApi\Exceptions\CTConfigException;
use CTApi\Exceptions\CTConnectException;
use CTApi\Requests\PersonRequest;
use PHPUnit\Framework\TestCase;

class TestConnectExceptions extends TestCase
{
    public function testApiUrlNotSet(){
        $this->expectException(CTConfigException::class);
        PersonRequest::whoami();
    }

    public function testApiUrlNotRechable(){
        $this->expectException(CTConnectException::class);
        CTConfig::setApiUrl("http://novalidsubdomain.lukasdumberger.de/");
        PersonRequest::whoami();
    }

}