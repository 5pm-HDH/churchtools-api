<?php


namespace CTApi\Models\Common\Search;


use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;
use CTApi\Utils\CTUtil;

class SearchRequestBuilder
{
    private array $domainTypes = [];

    public function __construct(
        private string $query
    )
    {
    }

    public function whereDomainType(string $domainType)
    {
        if(!in_array($domainType, $this->domainTypes)){
            $this->domainTypes[] = $domainType;
        }
        return $this;
    }

    public function get(): array
    {
        $options = [
            "json" => [
                "query" => $this->query
            ]
        ];

        if(!empty($this->domainTypes)){
            CTUtil::arrayPathSet($options,"json.domainTypes", $this->domainTypes);
        }

        $client = CTClient::getClient();
        $response = $client->get('/api/search', $options);
        $data = CTResponseUtil::dataAsArray($response);
        return SearchResult::createModelsFromArray($data);
    }
}