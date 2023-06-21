<?php


namespace CTApi\Models\Events\Song;


use CTApi\Models\Common\Tag\TagRequestBuilder;
use CTApi\Traits\Request\AjaxApi;
use CTApi\Utils\CTResponseUtil;

class SongTagRequestBuilder
{
    use AjaxApi;

    public function __construct(
        private int $songId
    )
    {
    }

    public function get(): array
    {
        $songData = $this->getTagData();
        $songId = $this->songId;
        $filteredSongs = array_filter($songData, function ($song) use ($songId) {
            return $song["id"] == $songId;
        });
        $songElement = end($filteredSongs);

        if ($songElement === false) {
            return [];
        }

        $tags = $songElement["tags"] ?? [];

        $tagRequestBuilder = new TagRequestBuilder("songs");

        $tagsAsObjects = array_map(function ($tagId) use ($tagRequestBuilder) {
            return $tagRequestBuilder->find($tagId);
        }, $tags);
        return $tagsAsObjects;
    }

    private function getTagData(): array
    {
        $response = $this->requestAjax("churchservice/ajax", "getAllSongs", []);
        $data = CTResponseUtil::dataAsArray($response);

        if(array_key_exists("songs", $data)){
            return $data["songs"];
        }else{
            return $data;
        }
    }
}