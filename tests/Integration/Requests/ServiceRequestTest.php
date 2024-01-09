<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Events\Service\Service;
use CTApi\Models\Events\Service\ServiceGroup;
use CTApi\Models\Events\Service\ServiceGroupRequest;
use CTApi\Models\Events\Service\ServiceRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class ServiceRequestTest extends TestCaseAuthenticated
{
    public function testFindService(): void
    {
        $serviceId = IntegrationTestData::getFilter("get_service", "id");
        $serviceName = IntegrationTestData::getResult("get_service", "name");

        $service = ServiceRequest::find($serviceId);

        $this->assertNotNull($service);
        $this->assertEquals(IntegrationTestData::getResult("get_service", "name"), $service->getName());
    }

    public function testFindOrFailService(): void
    {
        $this->expectException(CTRequestException::class);
        ServiceRequest::findOrFail(929192818291);
    }

    public function testAllServices(): void
    {
        $services = ServiceRequest::all();

        $this->assertNotEmpty($services);
        foreach ($services as $service) {
            $this->assertInstanceOf(Service::class, $service);
        }
    }

    public function testServiceRequestServiceGroup(): void
    {
        $serviceId = IntegrationTestData::getFilter("get_service", "id");

        $service = ServiceRequest::findOrFail($serviceId);

        $serviceGroup = $service->requestServiceGroup();

        $this->assertInstanceOf(ServiceGroup::class, $serviceGroup);

        $serviceGroupId = IntegrationTestData::getResult("get_service", "service_group_id");
        $serviceGroupName = IntegrationTestData::getResult("get_service", "service_group_name");

        $this->assertEquals($serviceGroup->getId(), $serviceGroupId);
        $this->assertEquals($serviceGroup->getName(), $serviceGroupName);

        $nullService = new Service();

        $this->assertNull($nullService->requestServiceGroup());
    }

    public function testFindServiceGroup(): void
    {
        $serviceGroupId = IntegrationTestData::getResult("get_service", "service_group_id");
        $serviceGroupName = IntegrationTestData::getResult("get_service", "service_group_name");

        $serviceGroup = ServiceGroupRequest::find($serviceGroupId);

        $this->assertNotNull($serviceGroup);
        $this->assertEquals($serviceGroupName, $serviceGroup->getName());
    }

    public function testFindOrFailServiceGroup(): void
    {
        $this->expectException(CTRequestException::class);
        ServiceGroupRequest::findOrFail(929192818291);
    }

    public function testAllServiceGroups(): void
    {
        $serviceGroups = ServiceGroupRequest::all();

        $this->assertNotEmpty($serviceGroups);
        foreach ($serviceGroups as $serviceGroup) {
            $this->assertInstanceOf(ServiceGroup::class, $serviceGroup);
        }
    }

    public function testRequestServicesFromServiceGroup(): void
    {
        $serviceGroupId = IntegrationTestData::getResult("get_service", "service_group_id");
        $serviceId = IntegrationTestData::getFilter("get_service", "id");
        $serviceName = IntegrationTestData::getResult("get_service", "name");

        $serviceGroup = ServiceGroupRequest::findOrFail($serviceGroupId);

        $serviceRequestBuilder = $serviceGroup->requestServices();
        $this->assertNotNull($serviceRequestBuilder);
        $services = $serviceRequestBuilder->get();

        $foundService = false;
        foreach ($services as $service) {
            if ($service->getId() == $serviceId && $service->getName() == $serviceName) {
                $foundService = true;
            }
        }
        $this->assertTrue($foundService, "Service could not be retrieved from requestServices-method");
    }
}
