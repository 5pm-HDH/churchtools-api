# ServiceAPI

```php
use CTApi\Models\Service;use CTApi\Models\ServiceGroup;use CTApi\Requests\ServiceGroupRequest;use CTApi\Requests\ServiceRequest;

$serviceGroups = ServiceGroupRequest::all();
$services = ServiceRequest::all();

/**
 * Service-Model 
 */
$service = new Service();

echo "-".$service->getId();
echo "-".$service->getName();
echo "-".$service->getServiceGroupId();
echo "-".$service->getCommentOnConfirmation();
echo "-".$service->getSortKey();
echo "-".$service->getAllowDecline();
echo "-".$service->getAllowExchange();
echo "-".$service->getComment();
echo "-".$service->getStandard();
echo "-".$service->getHidePersonName();
echo "-".$service->getSendReminderMails();
echo "-".$service->getSendServiceRequestEmails();
echo "-".$service->getAllowControlLiveAgenda();
echo "-".$service->getGroupIds();
echo "-".$service->getTagIds();
echo "-".$service->getCalTextTemplate();
echo "-".$service->getAllowChat();

$serviceGroup = $service->requestServiceGroup();

/**
 * ServiceGroup-Model 
 */
$serviceGroup = new ServiceGroup();

echo "-".$serviceGroup->getId();
echo "-".$serviceGroup->getName();
echo "-".$serviceGroup->getSortKey();
echo "-".$serviceGroup->getViewAll();
echo "-".$serviceGroup->getCampusId();
echo "-".$serviceGroup->getOnlyVisibleInCampusFilter();

$services = $serviceGroup->requestServices();

```