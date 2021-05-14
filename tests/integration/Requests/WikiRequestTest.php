<?php


use CTApi\Models\WikiCategory;
use CTApi\Models\WikiPage;
use CTApi\Requests\WikiCategoryRequest;
use CTApi\Requests\WikiSearchRequest;

class WikiRequestTest extends TestCaseAuthenticated
{

    private string $CATEGORY_ID = "";
    private string $CATEGORY_NAME = "";
    private string $PAGE_IDENTIFIER = "";
    private string $PAGE_TITLE = "";
    private string $SEARCH_QUERY = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("WIKI_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }

        $this->CATEGORY_ID = TestData::getValue("WIKI_CATEGORY_ID") ?? "";
        $this->CATEGORY_NAME = TestData::getValue("WIKI_CATEGORY_NAME") ?? "";
        $this->PAGE_IDENTIFIER = TestData::getValue("WIKI_PAGE_IDENTIFIER") ?? "";
        $this->PAGE_TITLE = TestData::getValue("WIKI_PAGE_TITLE") ?? "";
        $this->SEARCH_QUERY = TestData::getValue("WIKI_SEARCH_QUERY") ?? "";
    }

    public function testWikiCategories()
    {
        $allCategories = WikiCategoryRequest::all();

        $this->assertNotEmpty($allCategories);
        foreach ($allCategories as $category) {
            $this->assertInstanceOf(WikiCategory::class, $category);
        }
    }

    public function testGetWikiCategory()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);

        $this->assertEquals($this->CATEGORY_ID, $category->getId());
        $this->assertEquals($this->CATEGORY_NAME, $category->getName());
    }

    public function testGetWikiCategoryFailed()
    {
        $category = WikiCategoryRequest::find(-9213);
        $this->assertNull($category);
    }

    public function testRequestWikiPages()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);

        $pages = $category->requestPages()->get();


        $this->assertNotEmpty($pages);

        $foundTestPage = false;
        foreach ($pages as $page) {
            $this->assertInstanceOf(WikiPage::class, $page);
            $this->assertInstanceOf(WikiCategory::class, $page->getWikiCategory());
            if ($this->PAGE_IDENTIFIER == $page->getIdentifier() && $this->PAGE_TITLE == $page->getTitle()) {
                $foundTestPage = true;
            }
        }
        $this->assertTrue($foundTestPage, "Could not found Test-Page in Request");
    }

    public function testRequestWikiPagesFailed()
    {
        $category = (new WikiCategory())->setId(-291);
        $pages = $category->requestPages()->get();
        $this->assertIsArray($pages);
        $this->assertEquals(0, sizeof($pages));
    }

    public function testRequestWikiPage()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);
        $page = $category->requestPage($this->PAGE_IDENTIFIER);

        $this->assertInstanceOf(WikiPage::class, $page);
        $this->assertNotNull($page->getText());
    }

    public function testRequestWikiPageFailed()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);
        $page = $category->requestPage("no-valid-page-key");

        $this->assertNull($page);
    }

    public function testRequestWikiPageVersions()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);
        $page = $category->requestPage($this->PAGE_IDENTIFIER);

        $versions = $page->requestVersions()->get();

        $this->assertNotNull($versions);
        foreach ($versions as $page) {
            $this->assertInstanceOf(WikiPage::class, $page);
        }
    }

    public function testRequestWikiPageVersionsFailed()
    {
        $page = new WikiPage();

        $versions = $page->requestVersions();
        $this->assertNull($versions);
    }

    public function testRequestWikiPageVersion()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);
        $page = $category->requestPage($this->PAGE_IDENTIFIER);

        $versions = $page->requestVersions()->get();

        $this->assertNotNull($versions);

        $failedVersion = $page->requestVersion(-2913);
        $this->assertNull($failedVersion);

        if (sizeof($versions) > 0) {
            $version = $versions[0];

            $versionRequested = $page->requestVersion($version->getVersion());

            $this->assertEquals($version->getIdentifier(), $versionRequested->getIdentifier());
            $this->assertEquals($version->getVersion(), $versionRequested->getVersion());
            $this->assertEquals($version->getText(), $versionRequested->getText());
        } else {
            $this->fail();
        }
    }

    public function testRequestWikiPageVersionFailed()
    {
        $page = new WikiPage();

        $versions = $page->requestVersion(921);
        $this->assertNull($versions);
    }

    public function testWikiSearch()
    {
        $searchResults = WikiSearchRequest::search($this->SEARCH_QUERY)->get();

        $this->assertGreaterThan(0, sizeof($searchResults));

        $result = $searchResults[0];

        $page = $result->requestWikiPage();
        $this->assertInstanceOf(WikiPage::class, $page);
    }

    public function testWikiTree()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);
        $rootNode = $category->requestWikiPageTree();

        $rootOverLink = $rootNode->getChildNodes()[0]->getParentNode();
        $this->assertEquals($rootNode, $rootOverLink);
    }
}