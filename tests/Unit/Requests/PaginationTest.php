<?php


namespace CTApi\Test\Unit\Requests;


use CTApi\CTConfig;
use CTApi\Models\Events\Event\EventRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class PaginationTest extends TestCaseHttpMocked
{

    public function testPagination()
    {
        CTConfig::setPaginationPageSize(6);
        EventRequest::all();
        $this->assertAllRequestContainLimit(6);
    }

    public function testManualPagination()
    {
        EventRequest::where("limit", 9)->get();
        $this->assertAllRequestContainLimit(9);
    }

    public function testOverrideManualPagination()
    {
        CTConfig::setPaginationPageSize(12);
        EventRequest::where("limit", 9)->get();
        $this->assertAllRequestContainLimit(9);
    }

    private function assertAllRequestContainLimit(?int $pageSize)
    {
        foreach ($this->getClientMock()->getAllRequestCalls() as $requestCall) {
            $this->assertRequestContainsLimit($requestCall, $pageSize);
        }
    }

    private function assertRequestContainsLimit(array $request, ?int $pageSize)
    {
        $this->assertArrayHasKey("options", $request);
        $this->assertArrayHasKey("query", $request["options"]);
        $this->assertArrayHasKey("limit", $request["options"]["query"]);
        $this->assertEquals($pageSize, $request["options"]["query"]["limit"]);
    }
}