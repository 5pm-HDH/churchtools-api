<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Events\Event\EventRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class PaginationTest extends TestCaseHttpMocked
{

    public function testCollectPages()
    {
        $events = EventRequest::all();
        $this->assertEquals(8, sizeof($events));
    }

    public function testCollectSinglePage()
    {
        $eventsPage1 = EventRequest::where("page", 1)
            ->where("limit", 3)->get();

        $this->assertEquals(3, sizeof($eventsPage1));

        // To get the next 3 events query for the second page:
        $eventsPage2 = EventRequest::where("page", 2)
            ->where("limit", 3)->get();

        $this->assertEquals(3, sizeof($eventsPage2));
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testIteratePages()
    {
        $page = 1;
        $limit = 15;

        do {
            $events = EventRequest::where('page', $page)
                ->where('limit', $limit)
                ->get();

            // do some stuff with the events
            $this->assertEquals(true, is_array($events));

            $page++;
        } while (count($events) === $limit);
    }
}