<?php


namespace Tests\Unit\Requests;


use CTApi\Requests\EventRequest;
use Tests\Unit\TestCaseHttpMocked;

class PaginationTest extends TestCaseHttpMocked
{

    public function testCollectPages()
    {
        $events = EventRequest::all();
        $this->assertEquals(8, sizeof($events));
    }

    public function testCollectSinglePage()
    {
        $eventsOfPage2 = EventRequest::where("page", 2)->where("limit", 3)->get();
        $this->assertEquals(3, sizeof($eventsOfPage2));
    }
}