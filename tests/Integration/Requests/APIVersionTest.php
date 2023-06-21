<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Models\Common\Info\InfoRequest;
use CTApi\Test\Integration\IntegrationTestData;
use PHPUnit\Framework\TestCase;


class APIVersionTest extends TestCase
{

    private static string $README_FILE = __DIR__ . '/../../../README.md';
    private static string $VERSION_REGEX = "/<version>(.*)<\/version>/";

    protected function setUp(): void
    {
        CTConfig::setApiUrl(IntegrationTestData::get()->getApiUrl());
    }

    /**
     * Request Version of API and writes it to README.md
     */
    public function testGetApiVersion()
    {
        $info = InfoRequest::getInfo();

        $this->assertArrayHasKey("build", $info);
        $this->assertArrayHasKey("version", $info);
        $this->setVersionInReadme($info["version"]);
    }

    private function setVersionInReadme(string $newVersion)
    {
        $str = file_get_contents(self::$README_FILE);
        $str = preg_replace(self::$VERSION_REGEX, "<version>" . $newVersion . "</version>", $str);
        file_put_contents(self::$README_FILE, $str);
    }
}