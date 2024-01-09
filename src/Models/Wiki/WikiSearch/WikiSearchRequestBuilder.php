<?php

namespace CTApi\Models\Wiki\WikiSearch;

use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Wiki\WikiPage\WikiPage;
use CTApi\Traits\Request\OrderByCondition;
use CTApi\Traits\Request\Pagination;
use CTApi\Traits\Request\WhereCondition;
use CTApi\Utils\CTResponseUtil;

class WikiSearchRequestBuilder
{
    use Pagination;
    use WhereCondition;
    use OrderByCondition;

    private string $query = "";

    public function search(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function get(): array
    {
        $options = [
            'query' => [
                'query' => $this->query
            ]
        ];
        $this->addWhereConditionsToOption($options);

        $data = $this->collectDataFromPages('/api/wiki/search', $options);

        $this->orderRawData($data);

        return WikiSearchResult::createModelsFromArray($data);
    }

    public static function requestWikiPageFromRawUrl(string $url): ?WikiPage
    {
        try {
            $response = CTClient::getClient()->get($url);
            $data = CTResponseUtil::dataAsArray($response);
            if (!empty($data)) {
                return WikiPage::createModelFromData($data);
            }
        } catch (CTRequestException $e) {
            // ignore
        }
        return null;
    }

}
