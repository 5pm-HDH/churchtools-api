<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\WikiPage;
use CTApi\Models\WikiSearchResult;
use CTApi\Requests\Traits\OrderByCondition;
use CTApi\Requests\Traits\Pagination;
use CTApi\Requests\Traits\WhereCondition;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class WikiSearchRequestBuilder
{

    private string $query = "";

    use Pagination, WhereCondition, OrderByCondition;

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
        } catch (GuzzleException $e) {
            // ignore
        }
        return null;
    }

}