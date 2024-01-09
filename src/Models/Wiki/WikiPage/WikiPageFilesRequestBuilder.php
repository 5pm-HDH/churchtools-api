<?php

namespace CTApi\Models\Wiki\WikiPage;

use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Common\File\File;
use CTApi\Utils\CTResponseUtil;

class WikiPageFilesRequestBuilder
{
    public function __construct(private $wikiCategory, private $pageIdentifier)
    {
    }

    public function get(): array
    {
        try {
            $response = CTClient::getClient()->get('/api/files/wiki_' . $this->wikiCategory . '/' . $this->pageIdentifier);
            $data = CTResponseUtil::dataAsArray($response);
            if (!empty($data)) {
                return File::createModelsFromArray($data);
            }
        } catch (CTRequestException $e) {
            //ingore
        }
        return [];
    }
}
