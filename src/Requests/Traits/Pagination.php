<?php

namespace CTApi\Requests\Traits;

use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\Utils\CTResponseUtil;

trait Pagination
{

    protected function collectDataFromPages(string $url, array $options = []): array
    {
        $client = CTClient::getClient();
        $collectedData = [];

        if (isset($options["query"]["page"])) {
            $manualPagination = true;
        } else {
            // Add Page Information to Options
            if (!array_key_exists("query", $options)) {
                $options["query"] = [];
            }
            $options["query"]["page"] = 1;

            $manualPagination = false;
        }

        //Collect Data from First Page
        $this->addPaginationPageSizeIfNotExists($options);
        $response = $client->get($url, $options);

        $metaInformation = CTResponseUtil::metaAsArray($response);
        $collectedData = array_merge($collectedData, CTResponseUtil::dataAsArray($response));


        if (!$manualPagination && array_key_exists("pagination", $metaInformation)) {
            $lastPage = $metaInformation["pagination"]["lastPage"];

            // Collect Date from Second till Last page
            for ($i = 2; $i <= $lastPage; $i++) {
                $options["query"]["page"] = $i;

                $response = $client->get($url, $options);

                $collectedData = array_merge($collectedData, CTResponseUtil::dataAsArray($response));
            }
        }

        return $collectedData;
    }

    private function addPaginationPageSizeIfNotExists(&$options)
    {
        if (CTConfig::getPaginationPageSize() != null && !array_key_exists("limit", $options["query"])) {
            $options["query"]["limit"] = CTConfig::getPaginationPageSize();
        }
    }
}