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

dd($service->getId());
dd($service->getName());
dd($service->getServiceGroupId());
dd($service->getCommentOnConfirmation());
dd($service->getSortKey());
dd($service->getAllowDecline());
dd($service->getAllowExchange());
dd($service->getComment());
dd($service->getStandard());
dd($service->getHidePersonName());
dd($service->getSendReminderMails());
dd($service->getSendServiceRequestEmails());
dd($service->getAllowControlLiveAgenda());
dd($service->getGroupIds());
dd($service->getTagIds());
dd($service->getCalTextTemplate());
dd($service->getAllowChat());

$serviceGroup = $service->requestServiceGroup();

/**
 * ServiceGroup-Model 
 */
$serviceGroup = new ServiceGroup();

dd($serviceGroup->getId());
dd($serviceGroup->getName());
dd($serviceGroup->getSortKey());
dd($serviceGroup->getViewAll());
dd($serviceGroup->getCampusId());
dd($serviceGroup->getOnlyVisibleInCampusFilter());

$services = $serviceGroup->requestServices();

```