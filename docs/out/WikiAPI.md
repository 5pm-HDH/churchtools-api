# Wiki-API

```php
        use CTApi\Models\Wiki\WikiCategory\WikiCategoryRequest;use CTApi\Models\Wiki\WikiSearch\WikiSearchRequest;

        /**
         * WikiCategory - Model
         */

        $wikiCategories = WikiCategoryRequest::all();
        $wikiCategory = WikiCategoryRequest::findOrFail(21);

        var_dump( $wikiCategory->getId());
        // Output: "21"

        var_dump( $wikiCategory->getName());
        // Output: ""

        var_dump( $wikiCategory->getNameTranslated());
        // Output: ""

        var_dump( $wikiCategory->getSortKey());
        // Output: ""

        var_dump( $wikiCategory->getCampusId());
        // Output: ""

        var_dump( $wikiCategory->getInMenu());
        // Output: ""

        var_dump( $wikiCategory->getFileAccessWithoutPermission());
        // Output: ""

        var_dump( $wikiCategory->getPermissions());
        // Output: []


        $allPages = $wikiCategory->requestPages()?->get() ?? [];

        /**
         * WikiPages - Model
         */
        $page = $allPages[0];

        var_dump( $page->getIdentifier());
        // Output: "Page21"

        var_dump( $page->getTitle());
        // Output: "Page A"

        var_dump( $page->getVersion());
        // Output: ""

        var_dump( $page->getOnStartPage());
        // Output: ""

        var_dump( $page->getRedirectTo());
        // Output: ""

        var_dump( $page->getIsMarkdown());
        // Output: ""

        var_dump( $page->getText());
        // Output: ""

        var_dump( $page->requestText()->getText());
        // Output: ""


        $filesList = "";
        foreach ($page->requestFiles()->get() as $file) {
            $filesList .= $file->getName() . ", ";
            // ...
            // More methods in SongAPI.md in section File-Model
        }
        var_dump( $filesList);
        // Output: ""


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
        var_dump( $subPages);
        // Output: ""


```