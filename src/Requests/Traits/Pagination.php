<?php

namespace CTApi\Requests\Traits;

use CTApi\CTClient;
use CTApi\Utils\CTResponseUtil;

trait Pagination
{

    private function collectDataFromPages(string $url, array $options = []): array
    {
        $client = CTClient::getClient();
        $collectedData = [];

        // Add Page Information to Options
        if (!array_key_exists("json", $options)) {
            $options["json"] = [];
        }
        $options["json"]["page"] = 1;

        //Collect Data from First Page
        $response = $client->get($url, $options);

        $metaInformation = CTResponseUtil::metaAsArray($response);
        $collectedData = array_merge($collectedData, CTResponseUtil::dataAsArray($response));


        if (array_key_exists("pagination", $metaInformation)) {
            $lastPage = $metaInformation["pagination"]["lastPage"];

            // Collect Date from Second till Last page
            for ($i = 2; $i <= $lastPage; $i++) {
                $options["json"]["page"] = $i;

                $response = $client->get($url, $options);

                $collectedData = array_merge($collectedData, CTResponseUtil::dataAsArray($response));
            }
        }

        return $collectedData;
    }
}