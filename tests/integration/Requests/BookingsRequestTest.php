<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Models\Resource;
use CTApi\Models\ResourceBooking;
use CTApi\Requests\BookingRequest;
use CTApi\Requests\ResourceBookingsRequest;
use CTApi\Requests\ResourceRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class BookingsRequestTest extends TestCaseAuthenticated
{
    private $resourceId1 = "";
    private $resourceId2 = "";
    private $fromDate = "";
    private $toDate = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("RESOURCE_BOOKINGS_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->resourceId1 = TestData::getValue("RESOURCE_BOOKINGS_RESOURCE_ID_1");
            $this->resourceId2 = TestData::getValue("RESOURCE_BOOKINGS_RESOURCE_ID_2");
            $this->fromDate = TestData::getValue("RESOURCE_BOOKINGS_FROM_DATE");
            $this->toDate = TestData::getValue("RESOURCE_BOOKINGS_TO_DATE");
        }
    }

    public function testRequestAllResources()
    {
        $resources = ResourceRequest::all();
        $this->assertTrue(sizeof($resources) >= 1);
    }

    public function testRequestBookingsOfResource()
    {
        $resource = Resource::createModelFromData(["id" => $this->resourceId1]);

        $this->assertInstanceOf(Resource::class, $resource);

        $bookings = $resource->requestBookings()
            ?->where("from", $this->fromDate)
            ->where("to", $this->toDate)
            ->get();

        $this->assertTrue(sizeof($bookings) >= 1);
        $this->assertInstanceOf(ResourceBooking::class, end($bookings));
    }

    public function testRequestBookingsFromRequest()
    {
        $resourceIds = [$this->resourceId1, $this->resourceId2];

        $bookings = ResourceBookingsRequest::forResources($resourceIds)->get();

        $this->assertTrue(sizeof($bookings) >= 1);
        $this->assertInstanceOf(ResourceBooking::class, end($bookings));

        $resources = [
            Resource::createModelFromData(["id" => $this->resourceId1]),
            Resource::createModelFromData(["id" => $this->resourceId2]),
        ];

        $bookings = ResourceBookingsRequest::forResources($resources)->get();

        $this->assertTrue(sizeof($bookings) >= 1);
        $this->assertInstanceOf(ResourceBooking::class, end($bookings));
    }

}