<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Common\Search\SearchRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class SearchRequestTest extends TestCaseHttpMocked
{
    public function testSearchGlobalFor5PM()
    {
        $results = SearchRequest::search("5pm")->get();
        $firstResult = $results[0];

        $this->assertEquals("5PM CREW WIKI", $firstResult->getTitle());
        $this->assertEquals("wiki_page", $firstResult->getDomainType());
        $this->assertEquals("baae1955-d28f-47b0-8d55-b32ca5174159", $firstResult->getDomainIdentifier());
        $this->assertEquals("file", $firstResult->getIcon());
        $this->assertEquals("https://intern.church.tools/api/wiki/categories/27/pages/baae1955-d28f-47b0-8d55-b32ca5174159/versions/26", $firstResult->getApiUrl());
        $this->assertEquals("https://intern.church.tools/wiki/27/main", $firstResult->getFrontendUrl());
        $this->assertEquals(null, $firstResult->getImageUrl());
        $this->assertEquals([], $firstResult->getDomainAttributes());
    }

    public function testSearchDomainFor5PM()
    {
        $results = SearchRequest::search("5pm")
            ->whereDomainType("wiki_page")
            ->whereDomainType("person")->get();
        $firstResult = $results[0];

        $this->assertEquals("5PM CREW WIKI", $firstResult->getTitle());
        $this->assertEquals("wiki_page", $firstResult->getDomainType());
        $this->assertEquals("baae1955-d28f-47b0-8d55-b32ca5174159", $firstResult->getDomainIdentifier());
        $this->assertEquals("file", $firstResult->getIcon());
        $this->assertEquals("https://intern.church.tools/api/wiki/categories/27/pages/baae1955-d28f-47b0-8d55-b32ca5174159/versions/26", $firstResult->getApiUrl());
        $this->assertEquals("https://intern.church.tools/wiki/27/main", $firstResult->getFrontendUrl());
        $this->assertEquals(null, $firstResult->getImageUrl());
        $this->assertEquals([], $firstResult->getDomainAttributes());
    }
}