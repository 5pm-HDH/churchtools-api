<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Requests\ResourceBookingsRequest;
use CTApi\Requests\ResourceRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class ResourceRequestTest extends TestCaseHttpMocked
{
    public function testLoadResourceMasterData()
    {
        $allResources = ResourceRequest::all();
        $firstResource = $allResources[0];

        $this->assertEquals("21", $firstResource->getId());
        $this->assertEquals("Worship Room", $firstResource->getName());
        $this->assertEquals("Rooms", $firstResource->getResourceType()?->getName());
    }

    public function testLoadBookingsFromResource()
    {
        $allResources = ResourceRequest::all();
        $firstResource = $allResources[0];

        $bookings = $firstResource->requestBookings()
            ?->where("from", "2021-02-22")
            ->where("to", "2021-02-26")
            ->get();

        $firstBooking = $bookings[0];

        $this->assertEquals("221", $firstBooking->getId());
        $this->assertEquals("Sunday Service", $firstBooking->getCaption());
        $this->assertEquals("8", $firstBooking->getVersion());
        $this->assertEquals("Matthew", $firstBooking->requestPerson()?->getFirstName());
        $this->assertEquals("2021-02-24T06:00:00Z", $firstBooking->getStartDate());
        $this->assertEquals("2", $firstBooking->getStatusId());

        // Status-IDs (see: https://intern.church.tools/api)
        // 1 - Wartet auf Bestätigung
        // 2 - Bestätigt
        // 3 - Abgelehnt
        // 99 - Gelöscht
    }

    public function testLoadBookingsFromResourceIds()
    {
        $bookings = ResourceBookingsRequest::forResources([21, 22, 23])
            ->where("from", "2021-02-22")
            ->where("status_ids", [2]) // only loads bookings with status id = 2 (Bestätigt)
            ->get();

        $firstBooking = $bookings[0];

        $this->assertEquals("221", $firstBooking->getId());
    }
}