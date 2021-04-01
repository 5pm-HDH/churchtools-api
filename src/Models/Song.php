<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Song
{
    use FillWithData;

    protected ?string $songId = null;
    protected ?string $arrangementId = null;
    protected ?string $title = null;
    protected ?string $arrangement = null;
    protected ?string $category = null;
    protected ?string $key = null;
    protected ?string $bpm = null;
    protected ?string $isDefault = null;

    protected function parseArray(string $key, array $data)
    {
        $this->{$key} = $data;
    }

    /**
     * @return string|null
     */
    public function getSongId(): ?string
    {
        return $this->songId;
    }

    /**
     * @param string|null $songId
     * @return Song
     */
    public function setSongId(?string $songId): Song
    {
        $this->songId = $songId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArrangementId(): ?string
    {
        return $this->arrangementId;
    }

    /**
     * @param string|null $arrangementId
     * @return Song
     */
    public function setArrangementId(?string $arrangementId): Song
    {
        $this->arrangementId = $arrangementId;
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
     * @return Song
     */
    public function setTitle(?string $title): Song
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArrangement(): ?string
    {
        return $this->arrangement;
    }

    /**
     * @param string|null $arrangement
     * @return Song
     */
    public function setArrangement(?string $arrangement): Song
    {
        $this->arrangement = $arrangement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     * @return Song
     */
    public function setCategory(?string $category): Song
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     * @return Song
     */
    public function setKey(?string $key): Song
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBpm(): ?string
    {
        return $this->bpm;
    }

    /**
     * @param string|null $bpm
     * @return Song
     */
    public function setBpm(?string $bpm): Song
    {
        $this->bpm = $bpm;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsDefault(): ?string
    {
        return $this->isDefault;
    }

    /**
     * @param string|null $isDefault
     * @return Song
     */
    public function setIsDefault(?string $isDefault): Song
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}