# Wiki-API

```php
use CTApi\Requests\WikiCategoryRequest;
use CTApi\Requests\WikiSearchRequest;

/**
 * WikiCategory - Model 
 */

$wikiCategories = WikiCategoryRequest::all();
$wikiCategory = WikiCategoryRequest::findOrFail(21);

echo ($wikiCategory->getId());
// OUTPUT: 21
echo ($wikiCategory->getName());
// OUTPUT: 
echo ($wikiCategory->getNameTranslated());
// OUTPUT: 
echo ($wikiCategory->getSortKey());
// OUTPUT: 
echo ($wikiCategory->getCampusId());
// OUTPUT: 
echo ($wikiCategory->getInMenu());
// OUTPUT: 
echo ($wikiCategory->getFileAccessWithoutPermission());
// OUTPUT: 
echo ($wikiCategory->getPermissions());
// OUTPUT: []

$allPages = $wikiCategory->requestPages()->get();

/**
 * WikiPages - Model 
 */
$page = $allPages[0];

echo ($page->getIdentifier());
// OUTPUT: Page21
echo ($page->getTitle());
// OUTPUT: Page A
echo ($page->getVersion());
// OUTPUT: 
echo ($page->getOnStartPage());
// OUTPUT: 
echo ($page->getRedirectTo());
// OUTPUT: 
echo ($page->getIsMarkdown());
// OUTPUT: 
echo ($page->getText());
// OUTPUT: 
echo ($page->requestText()->getText());
// OUTPUT: 

$filesList = "";
foreach($page->requestFiles()->get() as $file){
    $filesList .= $file->getName() . ", ";
    // ...
    // More methods in SongAPI.md in section File-Model
}
echo ($filesList);
// OUTPUT: 

$pageVersions = $page->requestVersions()->get();
$firstPageVersion = $page->requestVersion(1);

/**
 * Search WikiPages
 */

$searchResults = WikiSearchRequest::search('sermon');

foreach($searchResults as $searchResult){
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


$rootNodeWiki  = $wikiCategory->requestWikiPageTree();

$subPages = "";
foreach($rootNodeWiki->getChildNodes() as $node){
    $pageTreeList .= $node->getWikiPage()->getTitle() . ", ";
}

echo ($subPages);
// OUTPUT: 

```