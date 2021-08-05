<?php

namespace Tests\Integration\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Service;
use CTApi\Models\ServiceGroup;
use CTApi\Requests\ServiceGroupRequest;
use CTApi\Requests\ServiceRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class ServiceRequestTest extends TestCaseAuthenticated
{

    protected function setUp(): void
    {
        if (!TestData::getValue("SERVICE_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }
    }

    public function testFindService()
    {
        $serviceId = TestData::getValue("SERVICE_ID");
        $serviceName = TestData::getValue("SERVICE_NAME");

        $service = ServiceRequest::find($serviceId);

        $this->assertNotNull($service);
        $this->assertEquals($serviceName, $service->getName());
    }

    public function testFindOrFailService()
    {
        $this->expectException(CTRequestException::class);
        ServiceRequest::findOrFail(929192818291);
    }

    public function testAllServices()
    {
        $services = ServiceRequest::all();

        $this->assertNotEmpty($services);
        foreach ($services as $service) {
            $this->assertInstanceOf(Service::class, $service);
        }
    }

    public function testServiceRequestServiceGroup()
    {
        $serviceId = TestData::getValue("SERVICE_ID");
        $serviceGroupId = TestData::getValue("SERVICE_GROUP_ID");
        $serviceGroupName = TestData::getValue("SERVICE_GROUP_NAME");

        $service = ServiceRequest::findOrFail($serviceId);
        $this->assertNotNull($service);

        $serviceGroup = $service->requestServiceGroup();

        $this->assertInstanceOf(ServiceGroup::class, $serviceGroup);
        $this->assertEquals($serviceGroup->getId(), $serviceGroupId);
        $this->assertEquals($serviceGroup->getName(), $serviceGroupName);

        $nullService = new Service();

        $this->assertNull($nullService->requestServiceGroup());
    }

    public function testFindServiceGroup()
    {
        $serviceGroupId = TestData::getValue("SERVICE_GROUP_ID");
        $serviceGroupName = TestData::getValue("SERVICE_GROUP_NAME");

        $serviceGroup = ServiceGroupRequest::find($serviceGroupId);

        $this->assertNotNull($serviceGroup);
        $this->assertEquals($serviceGroupName, $serviceGroup->getName());
    }

    public function testFindOrFailServiceGroup()
    {
        $this->expectException(CTRequestException::class);
        ServiceGroupRequest::findOrFail(929192818291);
    }

    public function testAllServiceGroups()
    {
        $serviceGroups = ServiceGroupRequest::all();

        $this->assertNotEmpty($serviceGroups);
        foreach ($serviceGroups as $serviceGroup) {
            $this->assertInstanceOf(ServiceGroup::class, $serviceGroup);
        }
    }

    public function testRequestServicesFromServiceGroup()
    {
        $serviceGroupId = TestData::getValue("SERVICE_GROUP_ID");
        $serviceId = TestData::getValue("SERVICE_ID");
        $serviceName = TestData::getValue("SERVICE_NAME");

        $serviceGroup = ServiceGroupRequest::findOrFail($serviceGroupId);

        $services = $serviceGroup->requestServices()->get();

        $foundService = false;
        foreach ($services as $service) {
            if ($service->getId() == $serviceId && $service->getName() == $serviceName) {
                $foundService = true;
            }
        }
        $this->assertTrue($foundService, "Service could not be retrieved from requestServices-method");
    }
}