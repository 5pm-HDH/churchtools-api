<?php


use CTApi\Exceptions\CTRequestException;
use CTApi\Requests\ServiceRequest;

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

    public function testFindOrFail()
    {
        $this->expectException(CTRequestException::class);
        ServiceRequest::findOrFail(929192818291);
    }

    public function testAllServices()
    {
        $services = ServiceRequest::all();

        $this->assertNotEmpty($services);
        foreach ($services as $service) {
            $this->assertInstanceOf(\CTApi\Models\Service::class, $service);
        }
    }

}