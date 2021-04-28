<?php


use CTApi\CTConfig;
use PHPUnit\Framework\TestCase;

class TestCaseAuthenticated extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        CTConfig::setApiUrl(TestData::getValue('API_URL'));
        CTConfig::authWithCredentials(
            TestData::getValue('AUTH_EMAIL'),
            TestData::getValue('AUTH_PASSWORD')
        );
        CTConfig::enableCache();
    }
}
