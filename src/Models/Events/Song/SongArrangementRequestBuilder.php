<?php

namespace CTApi\Models\Events\Song;

class SongArrangementRequestBuilder
{
    private array $songArrangements = [];

    public function __construct(array $songArrangements)
    {
        $this->songArrangements = $songArrangements;
    }

    public function get(): array
    {
        return $this->songArrangements;
    }
}
