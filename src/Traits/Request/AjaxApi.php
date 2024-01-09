<?php

namespace CTApi\Traits\Request;

use CTApi\CTClient;
use Psr\Http\Message\ResponseInterface;

trait AjaxApi
{
    private array $keyTranslation = [];

    protected function setAjaxKeyTranslation($modelKey, $ajaxKey)
    {
        $this->keyTranslation[$modelKey] = $ajaxKey;
    }

    /**
     * @param string $ajaxQuery e.q. "churchservice/ajax"
     * @param string $ajaxFunction e.q. "editArrangement"
     * @param array $data model-data
     * @return ResponseInterface
     */
    protected function requestAjax(string $ajaxQuery, string $ajaxFunction, array $data): ResponseInterface
    {
        $translatedData = [];
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->keyTranslation)) {
                $key = $this->keyTranslation[$key];
            }
            $translatedData[$key] = $value;
        }

        $translatedData["func"] = $ajaxFunction;
        $client = CTClient::getClient();
        return $client->post('/index.php', [
            "query" => [
                "q" => $ajaxQuery
            ],
            "json" => $translatedData
        ]);
    }
}
