<?php

namespace CTApi\Models\Wiki\WikiPage;

use CTApi\Exceptions\CTModelException;

class WikiPageTreeNode
{
    protected ?WikiPage $wikiPage = null;
    protected ?WikiPageTreeNode $parentNode = null;
    /**
     * @var WikiPageTreeNode[]
     */
    protected array $childNodes = [];

    public static function processWikiPagesReturnRootNode(array $pages): WikiPageTreeNode
    {
        $rootPageFilterArray = array_filter($pages, function ($page) {
            return $page->getTitle() === "main";
        });

        if (empty($rootPageFilterArray)) {
            throw new CTModelException("Root-page could not be found. There is no page with title 'main'.");
        }
        $rootPage = array_shift($rootPageFilterArray);

        return self::processWikiPage($rootPage, $pages, null);
    }

    private static function processWikiPage(WikiPage $page, array &$pages, ?WikiPageTreeNode $wikiPageParentNode = null): WikiPageTreeNode
    {
        $pageTreeNode = new WikiPageTreeNode();
        $pageTreeNode->setWikiPage($page);
        $pageTreeNode->setParentNode($wikiPageParentNode);

        if (is_null($page->getText())) {
            $page->requestText();
        }

        $subPagesArray = []; // ["stringPos" => 29, "node" => ... ]

        foreach ($pages as $subPage) {
            if (!is_null($subPage)) {
                $linkString = '[[' . htmlentities($subPage->getTitle()) . ']]';

                // => Found Link to $subPage   <=
                if (str_contains((string) $page->getText(), $linkString)) {
                    $subPagesArray[] = [
                        'stringPos' => strpos((string) $page->getText(), $linkString),
                        'node' => self::processWikiPage($subPage, $pages, $pageTreeNode)
                    ];
                }
            }
        }

        usort($subPagesArray, function ($entryA, $entryB) {
            return $entryA['stringPos'] - $entryB['stringPos'];
        });

        $pageTreeNode->setChildNodes(array_map(function ($entry) {
            return $entry['node'];
        }, $subPagesArray));

        return $pageTreeNode;
    }

    public static function printWikiPageTreeNode(WikiPageTreeNode $wikiPageTreeNode, int $level = 1): void
    {
        $tabString = "";
        for ($i = 0; $i < $level; $i++) {
            $tabString .= "\t";
        }
        echo $tabString . '- ' . $wikiPageTreeNode->getWikiPage()?->getTitle() . "\n";

        foreach ($wikiPageTreeNode->getChildNodes() as $node) {
            self::printWikiPageTreeNode($node, $level + 1);
        }
    }

    public function addChildNode(WikiPageTreeNode $pageTreeNode): WikiPageTreeNode
    {
        array_push($this->childNodes, $pageTreeNode);
        return $this;
    }

    /**
     * @return WikiPage|null
     */
    public function getWikiPage(): ?WikiPage
    {
        return $this->wikiPage;
    }

    /**
     * @param WikiPage|null $wikiPage
     * @return WikiPageTreeNode
     */
    public function setWikiPage(?WikiPage $wikiPage): WikiPageTreeNode
    {
        $this->wikiPage = $wikiPage;
        return $this;
    }

    /**
     * @return WikiPageTreeNode|null
     */
    public function getParentNode(): ?WikiPageTreeNode
    {
        return $this->parentNode;
    }

    /**
     * @param WikiPageTreeNode|null $parentNode
     * @return WikiPageTreeNode
     */
    public function setParentNode(?WikiPageTreeNode $parentNode): WikiPageTreeNode
    {
        $this->parentNode = $parentNode;
        return $this;
    }

    /**
     * @return WikiPageTreeNode[]
     */
    public function getChildNodes(): array
    {
        return $this->childNodes;
    }

    /**
     * @param array $childNodes
     * @return WikiPageTreeNode
     */
    public function setChildNodes(array $childNodes): WikiPageTreeNode
    {
        $this->childNodes = $childNodes;
        return $this;
    }
}
