<?php

namespace CTApi\Models\Wiki\WikiPage;

use CTApi\CTClient;
use CTApi\Exceptions\CTRequestException;
use CTApi\Utils\CTResponseUtil;

class WikiPageRequestBuilder
{
    private int $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return WikiPage[]
     */
    public function get(): array
    {
        try {
            $data = CTClient::getClient()->get('/api/wiki/categories/' . $this->categoryId . '/pages');
            return WikiPage::createModelsFromArray(CTResponseUtil::dataAsArray($data));
        } catch (CTRequestException $e) {
            return [];
        }
    }

    public static function requestPageFromCategoryAndIdentifier(string $wikiCategory, string $pageIdentifier): ?WikiPage
    {
        try {
            $response = CTClient::getClient()->get('/api/wiki/categories/' . $wikiCategory . '/pages/' . $pageIdentifier);
            $data = CTResponseUtil::dataAsArray($response);
            if (!empty($data)) {
                return WikiPage::createModelFromData($data);
            }
        } catch (CTRequestException $e) {
            //ignore
        }
        return null;
    }

}
