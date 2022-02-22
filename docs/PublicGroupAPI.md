# Public-Group API

Load Data of Group Homepage with Hash-String. This route is public, so no authentication of the CTConfig is necessary.

```php
        use CTApi\Requests\PublicGroupRequest;


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
        var_dump( "Hash: ".$hash);
        // Output: "Hash: wryawBH318GLHasgm27awB0c241aj"


        $groupHomepage->getMeta();

        // Array of PublicGroups:
        $groups = $groupHomepage->getGroups();

```

The PublicGroup-Model is a Subtype of Group. So all methods of Group will be available in
PublicGroup: [GroupAPI](GroupAPI.md)

Further the PublicGroup-Model contains the following Methods:

```php
        use CTApi\Requests\PublicGroupRequest;

        $groupHomepage = PublicGroupRequest::get("wryawBH318GLHasgm27awB0c241aj");
        $group = $groupHomepage->getGroups()[0];

        var_dump( "Id: ". $group->getId());
        // Output: "Id: 221"

        var_dump( "Headline: ". $group->getSignUpHeadline());
        // Output: "Headline: Teilnahme beantragen"

        var_dump( "Max. Teilnehmer: ". $group->getMaxMemberCount());
        // Output: "Max. Teilnehmer: 42"

        var_dump( "Akt. Teilnehmer: ". $group->getCurrentMemberCount());
        // Output: "Akt. Teilnehmer: 30"

        var_dump( "Name: ". $group->getName());
        // Output: "Name: Jugendwoche Kraftberg"


        // GroupInformation
        var_dump( "Termin: ".$group->getInformation()?->getMeetingTime());
        // Output: "Termin: Freitag 01.03. um 16h bis Sonntag 03.03. um 24h"

        var_dump( "Kategorie: ".$group->getInformation()?->getGroupCategory()?->getNameTranslated());
        // Output: "Kategorie: Freizeit"

        var_dump( "Zielgruppe: ".$group->getInformation()?->getTargetGroup()?->getNameTranslated());
        // Output: "Zielgruppe: Jugendliche"

        var_dump( "Beschreibung: ".$group->getInformation()?->getNote());
        // Output: "Beschreibung: Eine spannende Freizeit erwartet dich!"

        var_dump( "Bild-Url: ".$group->getInformation()?->getImageUrl());
        // Output: "Bild-Url: https://test.church.tools/images/9281/2928912ioha8921ns891bs9"


        var_dump( "Location: ".$group->getInformation()?->getGroupPlaces()[0]->getName());
        // Output: "Location: Freizeitheim Rosenberg"

        var_dump( "Stadt: ".$group->getInformation()?->getGroupPlaces()[0]->getCity());
        // Output: "Stadt: Heilbronn"

        var_dump( "GeoLat: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLat());
        // Output: "GeoLat: 92.2912"

        var_dump( "GeoLng: ".$group->getInformation()?->getGroupPlaces()[0]->getGeoLng());
        // Output: "GeoLng: 2.291"


```

For More-Informations on the Attributes have a look at the SourceCode:

- [Group](../src/Models/Group.php)
- [PublicGroup](../src/Models/PublicGroup.php)
- [GroupInformation](../src/Models/GroupInformation.php)
- [TargetGroup](../src/Models/TargetGroup.php)
- [GroupCategory](../src/Models/GroupCategory.php)
- [GroupPlace](../src/Models/GroupPlace.php)
