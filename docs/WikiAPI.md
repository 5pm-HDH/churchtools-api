# Wiki-API

```php
use CTApi\Requests\WikiCategoryRequest;use CTApi\Requests\WikiSearchRequest;

/**
 * WikiCategory - Model 
 */

$wikiCategories = WikiCategoryRequest::all();
$wikiCategory = WikiCategoryRequest::find(21);

echo "-".$wikiCategory->getId();
echo "-".$wikiCategory->getName();
echo "-".$wikiCategory->getNameTranslated();
echo "-".$wikiCategory->getSortKey();
echo "-".$wikiCategory->getCampusId();
echo "-".$wikiCategory->getInMenu();
echo "-".$wikiCategory->getFileAccessWithoutPermission();
print_r($wikiCategory->getPermissions());

$allPages = $wikiCategory->requestPages()->get();

/**
 * WikiPages - Model 
 */
$page = $allPages[0];

echo "-".$page->getIdentifier();
echo "-".$page->getTitle();
echo "-".$page->getVersion();
echo "-".$page->getOnStartPage();
echo "-".$page->getRediretTo();
echo "-".$page->getIsMarkdown();
echo "-".$page->getText();
echo "-".$page->requestText();

foreach($page->requestFiles()->get() as $file){
    echo "> ".$file->getName();
    echo "> ".$file->downloadToClient();
    // ...
    // More methods in SongAPI.md in section File-Model
}

$pageVersions = $page->requestVersions()->get();
$firstPageVersion = $page->requestVersion(1);

/**
 * Search WikiPages
 */

$searchResults = WikiSearchRequest::search('sermon');

foreach($searchResults as $searchResult){
    echo "-".$searchResult->getTitle();
    echo "-".$searchResult->getDomainType();
    echo "-".$searchResult->getDomainIdentifier();
    echo "-".$searchResult->getApiUrl();
    echo "-".$searchResult->getFrontendUrl();
    echo "-".$searchResult->getImageUrl();
    echo "-".$searchResult->getPreview();  
    
    $wikiPage = $searchResult->requestWikiPage();  
}

/**
 * WikiPage Tree 
 */

$wikiCategory = WikiCategoryRequest::find(21);

$rootNodeWiki  = $wikiCategory->requestWikiPageTree();

echo "<h1>Table of content:</h1>";
echo "<ul class='first-level'>";
    // First Level
foreach($rootNodeWiki->getChildNodes() as $node){
    echo "<li>";
    echo $node->getWikiPage()->getTitle();
    
    echo "<ul class='second-level'>";
    foreach($node->getChildNodes() as $nodeSecondLevel){
        echo "<li>";
        echo $nodeSecondLevel->getWikiPage()->getTitle();
        echo "</li>";
    }   
    echo "</ul>";
    
    echo "</li>";

}
echo "</ul>";


```