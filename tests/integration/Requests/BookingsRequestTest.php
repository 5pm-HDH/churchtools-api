<?php


namespace Tests\Integration\Requests;


use CTApi\Models\Resource;
use CTApi\Models\ResourceBooking;
use CTApi\Requests\BookingRequest;
use CTApi\Requests\ResourceBookingsRequest;
use CTApi\Requests\ResourceRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class BookingsRequestTest extends TestCaseAuthenticated
{
    private $resourceId1 = "";
    private $resourceId2 = "";
    private $fromDate = "";
    private $toDate = "";

    private $bookingId1;
    private $bookingCaption1;
    private $bookingStartDate1;
    private $bookingId2;
    private $bookingCaption2;


    protected function setUp(): void
    {
        $this->resourceId1 = IntegrationTestData::getFilter("filter_bookings", "resource_1_id");
        $this->resourceId2 = IntegrationTestData::getFilter("filter_bookings", "resource_2_id");
        $this->fromDate = IntegrationTestData::getFilter("filter_bookings", "from");
        $this->toDate = IntegrationTestData::getFilter("filter_bookings", "to");

        $this->bookingId1 = IntegrationTestData::getResult("filter_bookings", "any_booking_for_1.id");
        $this->bookingCaption1 = IntegrationTestData::getResult("filter_bookings", "any_booking_for_1.caption");
        $this->bookingStartDate1 = IntegrationTestData::getResult("filter_bookings", "any_booking_for_1.start_date");
        $this->bookingId2 = IntegrationTestData::getResult("filter_bookings", "any_booking_for_2.id");
        $this->bookingCaption2 = IntegrationTestData::getResult("filter_bookings", "any_booking_for_2.caption");
    }

    public function testRequestAllResources()
    {
        $resources = ResourceRequest::all();
        $this->assertTrue(sizeof($resources) >= 1);

        $foundResource = null;
        foreach ($resources as $resource) {
            if ($resource->getId() == IntegrationTestData::getResult("list_resources", "any_resource.id")) {
                $foundResource = $resource;
            }
        }

        $this->assertNotNull($foundResource);
        $this->assertEqualsTestData("list_resources", "any_resource.id", $foundResource->getId());
        $this->assertEqualsTestData("list_resources", "any_resource.name", $foundResource->getName());
        $this->assertEqualsTestData("list_resources", "any_resource.resource_type_name", $foundResource->getResourceType()?->getName());
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

        $foundBooking = null;
        foreach ($bookings as $booking) {
            if ($booking->getId() == $this->bookingId1) {
                $foundBooking = $booking;
            }
        }

        $this->assertNotNull($foundBooking);
        $this->assertEquals($this->bookingCaption1, $foundBooking->getCaption());
        $this->assertEquals($this->bookingStartDate1, $foundBooking->getStartDate());
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

        $foundBooking1 = null;
        $foundBooking2 = null;

        foreach ($bookings as $booking) {
            if ($booking->getId() == $this->bookingId1) {
                $foundBooking1 = $booking;
            }
            if ($booking->getId() == $this->bookingId2) {
                $foundBooking2 = $booking;
            }
        }

        $this->assertNotNull($foundBooking1);
        $this->assertEquals($this->bookingCaption1, $foundBooking1->getCaption());

        $this->assertNotNull($foundBooking2);
        $this->assertEquals($this->bookingCaption2, $foundBooking2->getCaption());
    }

}