<?php

namespace CTApi\Models\Events\Song;

use CTApi\Traits\Request\AjaxApi;
use CTApi\Utils\CTResponseUtil;

class SongCommentRequestBuilder
{

    use AjaxApi;

    public function __construct(
        private int $arrangementId
    )
    {
    }

    public function getComments()
    {
        $response = $this->requestAjax("churchservice/ajax", "getComments", [
            "domain_type" => "arrangement",
            "domain_id" => $this->arrangementId
        ]);

        $data = CTResponseUtil::dataAsArray($response);
        return SongComment::createModelsFromArray(array_values($data));
    }

    public function createComment(string $text): void
    {
        $this->requestAjax("churchservice/ajax", "addComment", [
            "domain_type" => "arrangement",
            "domain_id" => $this->arrangementId,
            "text" => $text
        ]);
    }

    public function deleteComment(int $commentId): void
    {
        $this->requestAjax("churchservice/ajax", "delComment", [
            "id" => $commentId,
        ]);
    }

}