# Public-Group API

Load Data of Group Homepage with Hash-String. This route is public, so no authentication of the CTConfig is necessary.

```php
use \CTApi\Requests\PublicGroupRequest;

$groupHomepage = PublicGroupRequest::get("wryawBH318GLHasgm27awB0c241aj");

$groupHomepage->getId();
$groupHomepage->getIsEnabled();
$groupHomepage->getShowLeader();
$groupHomepage->getShowMap();
$groupHomepage->getShowFilter();
$groupHomepage->getDefaultView();
$groupHomepage->getSortBy();
$groupHomepage->getOrderDirection();

$hash = $groupHomepage->getRandomUrl();
dd("Hash: ".$hash);

$groupHomepage->getMeta();

// Array of PublicGroups:
$groups = $groupHomepage->getGroups();
```

The PublicGroup-Model is a Subtype of Group. So all methods of Group will be available in
PublicGroup: [GroupAPI](GroupAPI.md)

Further the PublicGroup-Model contains the following Methods:

```php
use \CTApi\Requests\PublicGroupRequest;

$groupHomepage = PublicGroupRequest::get("wryawBH318GLHasgm27awB0c241aj");
$group = $groupHomepage->getGroups()[0];

dd("Id: ". $group->getId());
dd("Headline: ". $group->getSignUpHeadline());
dd("Max. Teilnehmer: ". $group->getMaxMemberCount());
dd("Akt. Teilnehmer: ". $group->getCurrentMemberCount());
dd("Name: ". $group->getName());

// GroupInformation
dd("Termin: ".$group->getInformation()?->getMeetingTime());
dd("Kategorie: ".$group->getInformation()?->getGroupCategory()?->getNameTranslated());
dd("Zielgruppe: ".$group->getInformation()?->getTargetGroup()?->getNameTranslated());
dd("Beschreibung: ".$group->getInformation()?->getNote());
dd("Bild-Url: ".$group->getInformation()?->getImageUrl());

dd("Location: ".$group->getInformation()?->getGroupPlaces()[0]->getName());
dd("Stadt: ".$group->getInformation()?->getGroupPlaces()[0]->getCity());
dd("GeoLat: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLat());
dd("GeoLng: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLng());
```

For More-Informations on the Attributes have a look at the SourceCode:

- [Group](../src/Models/Group.php)
- [PublicGroup](../src/Models/PublicGroup.php)
- [GroupInformation](../src/Models/GroupInformation.php)
- [TargetGroup](../src/Models/TargetGroup.php)
- [GroupCategory](../src/Models/GroupCategory.php)
- [GroupPlace](../src/Models/GroupPlace.php)
