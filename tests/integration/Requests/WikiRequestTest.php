<?php


use CTApi\Models\WikiCategory;
use CTApi\Requests\WikiCategoryRequest;

class WikiRequestTest extends TestCaseAuthenticated
{

    private string $CATEGORY_ID = "";
    private string $CATEGORY_NAME = "";

    protected function setUp(): void
    {
        if (!TestData::getValue("WIKI_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        }

        $this->CATEGORY_ID = TestData::getValue("WIKI_CATEGORY_ID") ?? "";
        $this->CATEGORY_NAME = TestData::getValue("WIKI_CATEGORY_NAME") ?? "";

    }

    public function testWikiCategories()
    {
        $allCategories = WikiCategoryRequest::all();

        $this->assertNotEmpty($allCategories);
        foreach ($allCategories as $category) {
            $this->assertInstanceOf(WikiCategory::class, $category);
        }

        print_r($allCategories);
    }

    public function testGetWikiCategory()
    {
        $category = WikiCategoryRequest::find($this->CATEGORY_ID);

        $this->assertEquals($this->CATEGORY_ID, $category->getId());
        $this->assertEquals($this->CATEGORY_NAME, $category->getName());
    }

}