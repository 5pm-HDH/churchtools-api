<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Common\File\File;
use CTApi\Models\Wiki\WikiCategory\WikiCategory;
use CTApi\Models\Wiki\WikiCategory\WikiCategoryRequest;
use CTApi\Models\Wiki\WikiPage\WikiPage;
use CTApi\Models\Wiki\WikiSearch\WikiSearchRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;


class WikiRequestTest extends TestCaseAuthenticated
{
    public function testWikiCategories(): void
    {
        $allCategories = WikiCategoryRequest::all();

        $this->assertNotEmpty($allCategories);
        foreach ($allCategories as $category) {
            $this->assertInstanceOf(WikiCategory::class, $category);
        }
    }

    public function testGetWikiCategory(): void
    {
        $categoryId = IntegrationTestData::getFilter("get_wiki_category", "id");
        $category = WikiCategoryRequest::find($categoryId);

        $this->assertNotNull($category);
        $this->assertEquals($categoryId, $category->getId());

        $categoryName = IntegrationTestData::getResult("get_wiki_category", "name");
        $this->assertEquals($categoryName, $category->getName());
    }

    public function testGetWikiCategoryFailed(): void
    {
        $category = WikiCategoryRequest::find(-9213);
        $this->assertNull($category);
    }

    public function testRequestWikiPages(): void
    {
        $categoryId = IntegrationTestData::getFilter("get_wiki_category", "id");
        $category = WikiCategoryRequest::find($categoryId);

        $pages = $category?->requestPages()?->get();
        $this->assertNotNull($pages);
        $this->assertNotEmpty($pages);

        $foundTestPage = false;
        foreach ($pages as $page) {
            $this->assertInstanceOf(WikiPage::class, $page);
            $this->assertInstanceOf(WikiCategory::class, $page->getWikiCategory());
            if (IntegrationTestData::getResult("get_wiki_category", "any_page.identifier") == $page->getIdentifier()
                && IntegrationTestData::getResult("get_wiki_category", "any_page.title") == $page->getTitle()) {
                $foundTestPage = true;
            }
        }
        $this->assertTrue($foundTestPage, "Could not found Test-Page in Request");
    }

    public function testRequestWikiPagesFailed(): void
    {
        $category = (new WikiCategory())->setId("-291");
        $pages = $category->requestPages()?->get();
        $this->assertNotNull($pages);
        $this->assertEquals(0, sizeof($pages));
    }

    public function testRequestWikiPage(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $page = $category?->requestPage(IntegrationTestData::getFilter("get_wiki_page", "page_identifier"));

        $this->assertInstanceOf(WikiPage::class, $page);
        $this->assertNotNull($page->getText());
        $this->assertEquals(IntegrationTestData::getResult("get_wiki_page", "title"), $page->getTitle());
    }

    public function testRequestWikiPageFiles(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $page = $category?->requestPage(IntegrationTestData::getFilter("get_wiki_page", "page_identifier"));

        $files = $page?->requestFiles()?->get();

        $this->assertNotNull($files);
        $this->assertTrue(sizeof($files) > 0, "There should be files.");

        $expectedFileName = IntegrationTestData::getResult("get_wiki_page", "any_file.name");

        $foundFile = false;
        foreach ($files as $file) {
            $this->assertNotNull($file);
            $this->assertInstanceOf(File::class, $file);

            if ($file->getName() == $expectedFileName) {
                $foundFile = true;
            }
        }
        $this->assertTrue($foundFile, "Could not find file on wiki page.");
    }

    public function testRequestWikiPageFailed(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $page = $category?->requestPage("no-valid-page-key");

        $this->assertNull($page);
    }

    public function testRequestWikiPageVersions(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $page = $category?->requestPage(IntegrationTestData::getFilter("get_wiki_page", "page_identifier"));

        $versions = $page?->requestVersions()?->get();

        $this->assertNotNull($versions);
        foreach ($versions as $page) {
            $this->assertInstanceOf(WikiPage::class, $page);
        }
    }

    public function testRequestWikiPageVersionsFailed(): void
    {
        $page = new WikiPage();

        $versions = $page->requestVersions();
        $this->assertNull($versions);
    }

    public function testRequestWikiPageVersion(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $page = $category?->requestPage(IntegrationTestData::getFilter("get_wiki_page", "page_identifier"));
        $this->assertNotNull($page);

        $versions = $page->requestVersions()?->get();
        $this->assertNotNull($versions);

        $failedVersion = $page->requestVersion(-2913);
        $this->assertNull($failedVersion);

        if (sizeof($versions) > 0) {
            $version = $versions[0];

            $versionRequested = $page->requestVersion($version->getVersion());

            $this->assertNotNull($versionRequested);
            $this->assertEquals($version->getIdentifier(), $versionRequested->getIdentifier());
            $this->assertEquals($version->getVersion(), $versionRequested->getVersion());
            $this->assertEquals($version->getText(), $versionRequested->getText());
        } else {
            $this->fail();
        }
    }

    public function testRequestWikiPageVersionFailed(): void
    {
        $page = new WikiPage();

        $versions = $page->requestVersion(921);
        $this->assertNull($versions);
    }

    public function testWikiSearch(): void
    {
        $searchResults = WikiSearchRequest::search(IntegrationTestData::getFilter("search_wiki_page", "search_query"))->get();

        $this->assertGreaterThan(0, sizeof($searchResults));

        $result = $searchResults[0];

        $page = $result->requestWikiPage();
        $this->assertInstanceOf(WikiPage::class, $page);
    }

    public function testWikiTree(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $rootNode = $category?->requestWikiPageTree();

        $this->assertNotNull($rootNode);
        $rootOverLink = $rootNode->getChildNodes()[0]->getParentNode();
        $this->assertEquals($rootNode, $rootOverLink);
    }

    public function testWikiMeta(): void
    {
        $categoryId = IntegrationTestData::getFilterAsInt("get_wiki_page", "category_id");
        $category = WikiCategoryRequest::find($categoryId);
        $pages = $category?->requestPages()?->get();

        $this->assertNotNull($pages);
        $this->assertNotEmpty($pages);
        $page = $pages[0];

        $this->assertNotNull($page->getMeta()->getModifiedPerson()->getId());
    }
}