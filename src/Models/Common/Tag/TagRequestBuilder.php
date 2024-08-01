<?php

namespace CTApi\Models\Common\Tag;

use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Utils\CTResponseUtil;

class TagRequestBuilder
{
    /**
     * @var Tag[]
     */
    private array $tags = [];

    public function __construct(
        private string $type
    ) {
        $this->tags = $this->retrieveData();
    }

    /**
     * @return Tag[]
     */
    private function retrieveData(): array
    {
        $client = CTClient::getClient();
        $response = $client->get("/api/tags", ["query" => ["type" => $this->type]]);
        $data = CTResponseUtil::dataAsArray($response);
        return Tag::createModelsFromArray($data);
    }

    private function filterTag(int $tagId): ?Tag
    {
        $filteredTags = array_filter($this->tags, function (Tag $tag) use ($tagId) {
            return $tag->getIdAsInteger() == $tagId;
        });
        $foundTag = end($filteredTags);
        if($foundTag === false) {
            return null;
        }
        return $foundTag;
    }

    public function find(int $id): ?Tag
    {
        return $this->filterTag($id);
    }

    public function findOrFail(int $id): Tag
    {
        $tag = $this->find($id);
        if($tag == null) {
            throw CTRequestException::ofModelNotFound(Tag::class);
        }
        return $tag;
    }

    /**
     * @return Tag[]
     */
    public function all(): array
    {
        return $this->tags;
    }
}
