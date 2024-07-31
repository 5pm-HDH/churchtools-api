<?php

namespace CTApi\Models\Events\Song;

use CTApi\CTClient;
use CTApi\Models\Common\Note\NoteRequest;
use CTApi\Traits\Request\AjaxApi;
use CTApi\Utils\CTResponseUtil;

/**
 * @deprecated Use NoteRequest::forSongArrangement() instead. This class will be removed in the next major-release v3.
 */
class SongCommentRequestBuilder
{
    use AjaxApi;

    public function __construct(
        private int $arrangementId
    ) {
    }

    public function getComments()
    {
        $ctClient = CTClient::getClient();
        $response = $ctClient->get("/api/notes/song_arrangement/" . $this->arrangementId);
        $data = CTResponseUtil::dataAsArray($response);
        if (empty($data)) {
            return [];
        } else {
            return SongComment::createModelsFromArray($data);
        }
    }

    public function createComment(string $text): void
    {
        NoteRequest::forSongArrangement($this->arrangementId)->create($text);
    }

    public function deleteComment(int $commentId): void
    {
        NoteRequest::forSongArrangement($this->arrangementId)->delete($commentId);
    }
}
