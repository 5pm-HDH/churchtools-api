<?php


namespace Tests\Unit\Docs;

use CTApi\Models\Service;
use CTApi\Models\ServiceGroup;
use CTApi\Requests\ServiceGroupRequest;
use CTApi\Requests\ServiceRequest;
use Tests\Unit\TestCaseHttpMocked;

class ServiceRequestTest extends TestCaseHttpMocked
{

    public function testExampleCode()
    {

        $serviceGroups = ServiceGroupRequest::all();
        $services = ServiceRequest::all();

        /**
         * Service-Model
         */
        $service = new Service();

        $this->assertEquals("", $service->getId());
        $this->assertEquals("", $service->getName());
        $this->assertEquals("", $service->getServiceGroupId());
        $this->assertEquals("", $service->getCommentOnConfirmation());
        $this->assertEquals("", $service->getSortKey());
        $this->assertEquals("", $service->getAllowDecline());
        $this->assertEquals("", $service->getAllowExchange());
        $this->assertEquals("", $service->getComment());
        $this->assertEquals("", $service->getStandard());
        $this->assertEquals("", $service->getHidePersonName());
        $this->assertEquals("", $service->getSendReminderMails());
        $this->assertEquals("", $service->getSendServiceRequestEmails());
        $this->assertEquals("", $service->getAllowControlLiveAgenda());
        $this->assertEquals("", $service->getGroupIds());
        $this->assertEquals("", $service->getTagIds());
        $this->assertEquals("", $service->getCalTextTemplate());
        $this->assertEquals("", $service->getAllowChat());

        $serviceGroup = $service->requestServiceGroup();

        /**
         * ServiceGroup-Model
         */
        $serviceGroup = new ServiceGroup();

        $this->assertEquals("", $serviceGroup->getId());
        $this->assertEquals("", $serviceGroup->getName());
        $this->assertEquals("", $serviceGroup->getSortKey());
        $this->assertEquals("", $serviceGroup->getViewAll());
        $this->assertEquals("", $serviceGroup->getCampusId());
        $this->assertEquals("", $serviceGroup->getOnlyVisibleInCampusFilter());

        $services = $serviceGroup->requestServices();
    }
}