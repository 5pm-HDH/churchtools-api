# Wiki-API

```php
use CTApi\Requests\WikiCategoryRequest;
use CTApi\Requests\WikiSearchRequest;

/**
 * WikiCategory - Model 
 */

$wikiCategories = WikiCategoryRequest::all();
$wikiCategory = WikiCategoryRequest::findOrFail(21);

dd($wikiCategory->getId());
dd($wikiCategory->getName());
dd($wikiCategory->getNameTranslated());
dd($wikiCategory->getSortKey());
dd($wikiCategory->getCampusId());
dd($wikiCategory->getInMenu());
dd($wikiCategory->getFileAccessWithoutPermission());
dd($wikiCategory->getPermissions());

$allPages = $wikiCategory->requestPages()->get();

/**
 * WikiPages - Model 
 */
$page = $allPages[0];

dd($page->getIdentifier());
dd($page->getTitle());
dd($page->getVersion());
dd($page->getOnStartPage());
dd($page->getRedirectTo());
dd($page->getIsMarkdown());
dd($page->getText());
dd($page->requestText()->getText());

$filesList = "";
foreach($page->requestFiles()->get() as $file){
    $filesList .= $file->getName() . ", ";
    // ...
    // More methods in SongAPI.md in section File-Model
}
dd($filesList);

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

dd($subPages);
```