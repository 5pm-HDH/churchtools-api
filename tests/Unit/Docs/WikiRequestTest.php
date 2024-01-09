<?php

namespace CTApi\Test\Unit\Docs;

use CTApi\Models\Wiki\WikiCategory\WikiCategoryRequest;
use CTApi\Models\Wiki\WikiSearch\WikiSearchRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class WikiRequestTest extends TestCaseHttpMocked
{
    public function testExampleCode()
    {
        /**
         * WikiCategory - Model
         */

        $wikiCategories = WikiCategoryRequest::all();
        $wikiCategory = WikiCategoryRequest::findOrFail(21);

        $this->assertEquals("21", $wikiCategory->getId());
        $this->assertEquals("", $wikiCategory->getName());
        $this->assertEquals("", $wikiCategory->getNameTranslated());
        $this->assertEquals("", $wikiCategory->getSortKey());
        $this->assertEquals("", $wikiCategory->getCampusId());
        $this->assertEquals("", $wikiCategory->getInMenu());
        $this->assertEquals("", $wikiCategory->getFileAccessWithoutPermission());
        $this->assertEquals([], $wikiCategory->getPermissions());

        $allPages = $wikiCategory->requestPages()?->get() ?? [];

        /**
         * WikiPages - Model
         */
        $page = $allPages[0];

        $this->assertEquals("Page21", $page->getIdentifier());
        $this->assertEquals("Page A", $page->getTitle());
        $this->assertEquals("", $page->getVersion());
        $this->assertEquals("", $page->getOnStartPage());
        $this->assertEquals("", $page->getRedirectTo());
        $this->assertEquals("", $page->getIsMarkdown());
        $this->assertEquals("", $page->getText());
        $this->assertEquals("", $page->requestText()->getText());

        $filesList = "";
        foreach ($page->requestFiles()->get() as $file) {
            $filesList .= $file->getName() . ", ";
            // ...
            // More methods in SongAPI.md in section File-Model
        }
        $this->assertEquals("", $filesList);

        $pageVersions = $page->requestVersions()->get();
        $firstPageVersion = $page->requestVersion(1);

        /**
         * Search WikiPages
         */

        $searchResults = WikiSearchRequest::search('sermon')->get();

        foreach ($searchResults as $searchResult) {
            $searchResult->getTitle();
            $searchResult->getDomainType();
            $searchResult->getDomainIdentifier();
            $searchResult->getApiUrl();
            $searchResult->getFrontendUrl();
            $searchResult->getImageUrl();
            $searchResult->getPreview();

            $wikiPage = $searchResult->requestWikiPage();
        }

        /**
         * WikiPage Tree
         */

        $wikiCategory = WikiCategoryRequest::find(21);


        $rootNodeWiki = $wikiCategory?->requestWikiPageTree();

        $subPages = "";
        $childNodes = $rootNodeWiki?->getChildNodes() ?? [];
        foreach ($childNodes as $node) {
            $subPages .= $node->getWikiPage()->getTitle() . ", ";
        }
        $this->assertEquals("", $subPages);
    }
}
