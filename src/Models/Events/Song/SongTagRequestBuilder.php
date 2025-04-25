<?php

namespace CTApi\Models\Events\Song;

use CTApi\CTClient;
use CTApi\Models\Common\Tag\Tag;
use CTApi\Utils\CTResponseUtil;

class SongTagRequestBuilder
{
    public function __construct(
        private int $songId
    ) {
    }

    public function get(): array
    {
        
        $client = CTClient::getClient();
        $response = $client->get('/api/tags/song/'.$this->songId);
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }
}
