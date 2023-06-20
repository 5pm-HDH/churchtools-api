# ServiceAPI

```php
        use CTApi\Models\Service;
        use CTApi\Models\ServiceGroup;
        use CTApi\Requests\ServiceGroupRequest;
        use CTApi\Requests\ServiceRequest;
        use CTApi\Test\Unit\TestCaseHttpMocked;


        $serviceGroups = ServiceGroupRequest::all();
        $services = ServiceRequest::all();

        /**
         * Service-Model
         */
        $service = new Service();

        var_dump( $service->getId());
        // Output: ""

        var_dump( $service->getName());
        // Output: ""

        var_dump( $service->getServiceGroupId());
        // Output: ""

        var_dump( $service->getCommentOnConfirmation());
        // Output: ""

        var_dump( $service->getSortKey());
        // Output: ""

        var_dump( $service->getAllowDecline());
        // Output: ""

        var_dump( $service->getAllowExchange());
        // Output: ""

        var_dump( $service->getComment());
        // Output: ""

        var_dump( $service->getStandard());
        // Output: ""

        var_dump( $service->getHidePersonName());
        // Output: ""

        var_dump( $service->getSendReminderMails());
        // Output: ""

        var_dump( $service->getSendServiceRequestEmails());
        // Output: ""

        var_dump( $service->getAllowControlLiveAgenda());
        // Output: ""

        var_dump( $service->getGroupIds());
        // Output: ""

        var_dump( $service->getTagIds());
        // Output: ""

        var_dump( $service->getCalTextTemplate());
        // Output: ""

        var_dump( $service->getAllowChat());
        // Output: ""


        $serviceGroup = $service->requestServiceGroup();

        /**
         * ServiceGroup-Model
         */
        $serviceGroup = new ServiceGroup();

        var_dump( $serviceGroup->getId());
        // Output: ""

        var_dump( $serviceGroup->getName());
        // Output: ""

        var_dump( $serviceGroup->getSortKey());
        // Output: ""

        var_dump( $serviceGroup->getViewAll());
        // Output: ""

        var_dump( $serviceGroup->getCampusId());
        // Output: ""

        var_dump( $serviceGroup->getOnlyVisibleInCampusFilter());
        // Output: ""


        $services = $serviceGroup->requestServices();

```