<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class SongLyrics
{
    use FillWithData;

    protected ?string $title = null;
    protected ?string $songID = null;
    protected ?string $songNumber = null;
    protected ?string $cclid = null;
    protected ?string $disclaimer = null;
    protected ?string $type = null;

    protected array $authors = [];
    protected array $copyrights = [];
    protected array $lyricParts = [];

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return SongLyrics
     */
    public function setType(?string $type): SongLyrics
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     * @return SongLyrics
     */
    public function setAuthors(array $authors): SongLyrics
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCclid(): ?string
    {
        return $this->cclid;
    }

    /**
     * @param string|null $cclid
     * @return SongLyrics
     */
    public function setCclid(?string $cclid): SongLyrics
    {
        $this->cclid = $cclid;
        return $this;
    }

    /**
     * @return array
     */
    public function getCopyrights(): array
    {
        return $this->copyrights;
    }

    /**
     * @param array $copyrights
     * @return SongLyrics
     */
    public function setCopyrights(array $copyrights): SongLyrics
    {
        $this->copyrights = $copyrights;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisclaimer(): ?string
    {
        return $this->disclaimer;
    }

    /**
     * @param string|null $disclaimer
     * @return SongLyrics
     */
    public function setDisclaimer(?string $disclaimer): SongLyrics
    {
        $this->disclaimer = $disclaimer;
        return $this;
    }

    /**
     * @return array
     */
    public function getLyricParts(): array
    {
        return $this->lyricParts;
    }

    /**
     * @param array $lyricParts
     * @return SongLyrics
     */
    public function setLyricParts(array $lyricParts): SongLyrics
    {
        $this->lyricParts = $lyricParts;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSongID(): ?string
    {
        return $this->songID;
    }

    /**
     * @param string|null $songID
     * @return SongLyrics
     */
    public function setSongID(?string $songID): SongLyrics
    {
        $this->songID = $songID;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSongNumber(): ?string
    {
        return $this->songNumber;
    }

    /**
     * @param string|null $songNumber
     * @return SongLyrics
     */
    public function setSongNumber(?string $songNumber): SongLyrics
    {
        $this->songNumber = $songNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return SongLyrics
     */
    public function setTitle(?string $title): SongLyrics
    {
        $this->title = $title;
        return $this;
    }
}