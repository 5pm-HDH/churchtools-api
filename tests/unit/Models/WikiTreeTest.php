<?php

use CTApi\Exceptions\CTModelException;
use CTApi\Models\WikiPage;
use CTApi\Models\WikiPageTreeNode;
use PHPUnit\Framework\TestCase;

class WikiTreeTest extends TestCase
{
    private array $pages = [];

    private ?WikiPage $rootPage = null;
    private ?WikiPage $applePage = null;

    protected function setUp(): void
    {
        $this->rootPage = $this->addWikiPage("main", "Main Page [[fruits]] then a text [[vegetable]]");

        $this->addWikiPage("fruits", "Grocery list:\n - [[apple]], [[banana]], [[grape]]");
        $this->applePage = $this->addWikiPage("apple", "Apple Text");
        $this->addWikiPage("banana", "Banana Text");
        $this->addWikiPage("grape", "Grape Text");

        $this->addWikiPage("vegetable", "vegetable text: [[salad]], [[carrots]]");
        $this->addWikiPage("salad", "salad text");
        $this->addWikiPage("carrots", "carrot text");
    }

    private function addWikiPage($title, $content): WikiPage
    {
        $wikiPage = (new WikiPage())->setText($content)->setTitle($title);
        array_push($this->pages, $wikiPage);
        return $wikiPage;
    }


    public function testCreateTree()
    {
        $rootPageNode = WikiPageTreeNode::processWikiPagesReturnRootNode($this->pages);

        $this->assertEquals($rootPageNode->getWikiPage(), $this->rootPage);

        // main -> fruits -> apple
        $applePage = $rootPageNode->getChildNodes()[0]->getChildNodes()[0]->getWikiPage();
        $this->assertEquals($applePage, $this->applePage);

        // links to parent nodes
        $rootPageFromLink = $rootPageNode->getChildNodes()[0]->getChildNodes()[0]->getParentNode()->getParentNode();
        $this->assertEquals($rootPageNode, $rootPageFromLink);
    }

    public function testFailedTree()
    {
        $this->expectException(CTModelException::class);
        $rootPageNode = WikiPageTreeNode::processWikiPagesReturnRootNode([]);
    }

    public function testFailedTreeSecond()
    {
        $rootPageNode = WikiPageTreeNode::processWikiPagesReturnRootNode([$this->rootPage]);
        $this->assertEmpty($rootPageNode->getChildNodes());
    }

}