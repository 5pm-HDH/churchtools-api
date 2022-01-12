# ServiceAPI

```php
use CTApi\Models\Service;
use CTApi\Models\ServiceGroup;
use CTApi\Requests\ServiceGroupRequest;
use CTApi\Requests\ServiceRequest;

$serviceGroups = ServiceGroupRequest::all();
$services = ServiceRequest::all();

/**
 * Service-Model 
 */
$service = new Service();

echo ($service->getId());
// OUTPUT: 
echo ($service->getName());
// OUTPUT: 
echo ($service->getServiceGroupId());
// OUTPUT: 
echo ($service->getCommentOnConfirmation());
// OUTPUT: 
echo ($service->getSortKey());
// OUTPUT: 
echo ($service->getAllowDecline());
// OUTPUT: 
echo ($service->getAllowExchange());
// OUTPUT: 
echo ($service->getComment());
// OUTPUT: 
echo ($service->getStandard());
// OUTPUT: 
echo ($service->getHidePersonName());
// OUTPUT: 
echo ($service->getSendReminderMails());
// OUTPUT: 
echo ($service->getSendServiceRequestEmails());
// OUTPUT: 
echo ($service->getAllowControlLiveAgenda());
// OUTPUT: 
echo ($service->getGroupIds());
// OUTPUT: 
echo ($service->getTagIds());
// OUTPUT: 
echo ($service->getCalTextTemplate());
// OUTPUT: 
echo ($service->getAllowChat());
// OUTPUT: 

$serviceGroup = $service->requestServiceGroup();

/**
 * ServiceGroup-Model 
 */
$serviceGroup = new ServiceGroup();

echo ($serviceGroup->getId());
// OUTPUT: 
echo ($serviceGroup->getName());
// OUTPUT: 
echo ($serviceGroup->getSortKey());
// OUTPUT: 
echo ($serviceGroup->getViewAll());
// OUTPUT: 
echo ($serviceGroup->getCampusId());
// OUTPUT: 
echo ($serviceGroup->getOnlyVisibleInCampusFilter());
// OUTPUT: 

$services = $serviceGroup->requestServices();


```