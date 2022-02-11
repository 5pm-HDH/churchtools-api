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
echo ("Hash: ".$hash);
// OUTPUT: Hash: wryawBH318GLHasgm27awB0c241aj

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

echo ("Id: ". $group->getId());
// OUTPUT: Id: 221
echo ("Headline: ". $group->getSignUpHeadline());
// OUTPUT: Headline: Teilnahme beantragen
echo ("Max. Teilnehmer: ". $group->getMaxMemberCount());
// OUTPUT: Max. Teilnehmer: 42
echo ("Akt. Teilnehmer: ". $group->getCurrentMemberCount());
// OUTPUT: Akt. Teilnehmer: 30
echo ("Name: ". $group->getName());
// OUTPUT: Name: Jugendwoche Kraftberg

// GroupInformation
echo ("Termin: ".$group->getInformation()?->getMeetingTime());
// OUTPUT: Termin: Freitag, 01.03. um 16h bis Sonntag 03.03. um 24h
echo ("Kategorie: ".$group->getInformation()?->getGroupCategory()?->getNameTranslated());
// OUTPUT: Kategorie: Freizeit
echo ("Zielgruppe: ".$group->getInformation()?->getTargetGroup()?->getNameTranslated());
// OUTPUT: Zielgruppe: Jugendliche
echo ("Beschreibung: ".$group->getInformation()?->getNote());
// OUTPUT: Beschreibung: Eine spannende Freizeit erwartet dich!
echo ("Bild-Url: ".$group->getInformation()?->getImageUrl());
// OUTPUT: Bild-Url: https://test.church.tools/images/9281/2928912ioha8921ns891bs9

echo ("Location: ".$group->getInformation()?->getGroupPlaces()[0]->getName());
// OUTPUT: Location: Freizeitheim Rosenberg
echo ("Stadt: ".$group->getInformation()?->getGroupPlaces()[0]->getCity());
// OUTPUT: Stadt: Heilbronn
echo ("GeoLat: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLat());
// OUTPUT: GeoLat: 92.2912
echo ("GeoLng: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLng());
// OUTPUT: GeoLng: 2.291

```

For More-Informations on the Attributes have a look at the SourceCode:

- [Group](../src/Models/Group.php)
- [PublicGroup](../src/Models/PublicGroup.php)
- [GroupInformation](../src/Models/GroupInformation.php)
- [TargetGroup](../src/Models/TargetGroup.php)
- [GroupCategory](../src/Models/GroupCategory.php)
- [GroupPlace](../src/Models/GroupPlace.php)
