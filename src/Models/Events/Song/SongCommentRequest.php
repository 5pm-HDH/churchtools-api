<?php

namespace CTApi\Models\Events\Song;

class SongCommentRequest
{

    public static function getForSongArrangement(int $arrangementId): array
    {
        $builder = new SongCommentRequestBuilder($arrangementId);
        return $builder->getComments();
    }

    public static function create(int $arrangementId, string $text): void
    {
        $builder = new SongCommentRequestBuilder($arrangementId);
        $builder->createComment($text);
    }

    public static function delete(int $commentId): void
    {
        $builder = new SongCommentRequestBuilder(0);
        $builder->deleteComment($commentId);
    }

}