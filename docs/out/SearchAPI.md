# Search-API

## Search Global
```php
        use CTApi\Models\Common\Search\SearchRequest;

        $results = SearchRequest::search("5pm")->get();
        $firstResult = $results[0];

        var_dump( $firstResult->getTitle());
        // Output: "5PM CREW WIKI"

        var_dump( $firstResult->getDomainType());
        // Output: "wiki_page"

        var_dump( $firstResult->getDomainIdentifier());
        // Output: "baae1955-d28f-47b0-8d55-b32ca5174159"

        var_dump( $firstResult->getIcon());
        // Output: "file"

        var_dump( $firstResult->getApiUrl());
        // Output: "https://intern.church.tools/api/wiki/categories/27/pages/baae1955-d28f-47b0-8d55-b32ca5174159/versions/26"

        var_dump( $firstResult->getFrontendUrl());
        // Output: "https://intern.church.tools/wiki/27/main"

        var_dump( $firstResult->getImageUrl());
        // Output: null

        var_dump( $firstResult->getDomainAttributes());
        // Output: []


```

## Search in specific Domain-Types

**Available Domain-Types:**
* person
* group
* song
* wiki_page

```php
        use CTApi\Models\Common\Search\SearchRequest;

        $results = SearchRequest::search("5pm")
            ->whereDomainType("wiki_page")
            ->whereDomainType("person")->get();
        $firstResult = $results[0];

        var_dump( $firstResult->getTitle());
        // Output: "5PM CREW WIKI"

        var_dump( $firstResult->getDomainType());
        // Output: "wiki_page"

        var_dump( $firstResult->getDomainIdentifier());
        // Output: "baae1955-d28f-47b0-8d55-b32ca5174159"

        var_dump( $firstResult->getIcon());
        // Output: "file"

        var_dump( $firstResult->getApiUrl());
        // Output: "https://intern.church.tools/api/wiki/categories/27/pages/baae1955-d28f-47b0-8d55-b32ca5174159/versions/26"

        var_dump( $firstResult->getFrontendUrl());
        // Output: "https://intern.church.tools/wiki/27/main"

        var_dump( $firstResult->getImageUrl());
        // Output: null

        var_dump( $firstResult->getDomainAttributes());
        // Output: []


```