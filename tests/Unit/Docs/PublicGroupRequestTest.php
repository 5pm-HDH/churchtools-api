<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Requests\PublicGroupRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class PublicGroupRequestTest extends TestCaseHttpMocked
{
    public function testExampleCodePublicGroupInit()
    {
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
        $this->assertEquals("Hash: wryawBH318GLHasgm27awB0c241aj", "Hash: " . $hash);

        $groupHomepage->getMeta();

        // Array of PublicGroups:
        $groups = $groupHomepage->getGroups();
    }

    public function testExampleCodePublicGroup()
    {
        $groupHomepage = PublicGroupRequest::get("wryawBH318GLHasgm27awB0c241aj");
        $group = $groupHomepage->getGroups()[0];

        $this->assertEquals("Id: 221", "Id: " . $group->getId());
        $this->assertEquals("Headline: Teilnahme beantragen", "Headline: " . $group->getSignUpHeadline());
        $this->assertEquals("Max. Teilnehmer: 42", "Max. Teilnehmer: " . $group->getMaxMemberCount());
        $this->assertEquals("Akt. Teilnehmer: 30", "Akt. Teilnehmer: " . $group->getCurrentMemberCount());
        $this->assertEquals("Name: Jugendwoche Kraftberg", "Name: " . $group->getName());

        // GroupInformation
        $this->assertEquals("Termin: Freitag 01.03. um 16h bis Sonntag 03.03. um 24h", "Termin: " . $group->getInformation()?->getMeetingTime());
        $this->assertEquals("Kategorie: Freizeit", "Kategorie: " . $group->getInformation()?->getGroupCategory()?->getNameTranslated());
        $this->assertEquals("Zielgruppe: Jugendliche", "Zielgruppe: " . $group->getInformation()?->getTargetGroup()?->getNameTranslated());
        $this->assertEquals("Beschreibung: Eine spannende Freizeit erwartet dich!", "Beschreibung: " . $group->getInformation()?->getNote());
        $this->assertEquals("Bild-Url: https://test.church.tools/images/9281/2928912ioha8921ns891bs9", "Bild-Url: " . $group->getInformation()?->getImageUrl());

        $this->assertEquals("Location: Freizeitheim Rosenberg", "Location: " . $group->getInformation()?->getGroupPlaces()[0]?->getName());
        $this->assertEquals("Stadt: Heilbronn", "Stadt: " . $group->getInformation()?->getGroupPlaces()[0]?->getCity());
        $this->assertEquals("GeoLat: 92.2912", "GeoLat: " . $group->getInformation()?->getGroupPlaces()[0]?->getGeoLat());
        $this->assertEquals("GeoLng: 2.291", "GeoLng: " . $group->getInformation()?->getGroupPlaces()[0]?->getGeoLng());
    }
}