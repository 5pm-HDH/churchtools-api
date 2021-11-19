<?php


namespace CTApi\Requests;


use CTApi\CTClient;
use CTApi\Models\File;
use CTApi\Utils\CTResponseUtil;
use GuzzleHttp\Exception\GuzzleException;

class WikiPageFilesRequestBuilder
{
    public function __construct(private $wikiCategory, private $pageIdentifier)
    {
    }

    public function get()
    {
        try {
            $response = CTClient::getClient()->get('/api/files/wiki_' . $this->wikiCategory . '/' . $this->pageIdentifier);
            $data = CTResponseUtil::dataAsArray($response);
            if (!empty($data)) {
                return File::createModelsFromArray($data);
            }
        } catch (GuzzleException $e) {
            //ingore
        }
        return [];
    }
}