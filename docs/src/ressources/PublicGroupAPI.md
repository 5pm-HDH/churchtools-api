# Public-Group API

```php
use \CTApi\Requests\PublicGroupRequest;

$groupHomepage = PublicGroupRequest::get("SOME_HASH_STRING");

$groupHomepage->getId();
$groupHomepage->getIsEnabled();
$groupHomepage->getShowLeader();
$groupHomepage->getShowMap();
$groupHomepage->getShowFilter();
$groupHomepage->getDefaultView();
$groupHomepage->getSortBy();
$groupHomepage->getOrderDirection();

$groupHomepage->getRandomUrl();
// RandomUrl = "SOME_HASH_STRING"

$groupHomepage->getMeta();
$groups = $groupHomepage->getGroups();
// Array of PublicGroups
// PublicGroup is a subtype of Group
```