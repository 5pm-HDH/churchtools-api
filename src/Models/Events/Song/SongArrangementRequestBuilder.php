<?php

namespace CTApi\Models\Events\Song;

class SongArrangementRequestBuilder
{
    /**
     * @var SongArrangement[]
     */
    private array $songArrangements = [];

    /**
     * @param SongArrangement[] $songArrangements
     */
    public function __construct(array $songArrangements)
    {
        $this->songArrangements = $songArrangements;
    }

    /**
     * @return SongArrangement[]
     */
    public function get(): array
    {
        return $this->songArrangements;
    }
}
