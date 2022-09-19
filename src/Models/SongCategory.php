<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class SongCategory extends AbstractModel
{
    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;
    protected ?string $campusId = null;

    use FillWithData;

    /**
     * @param string|null $id
     * @return SongCategory
     */
    public function setId(?string $id): SongCategory
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return SongCategory
     */
    public function setName(?string $name): SongCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameTranslated(): ?string
    {
        return $this->nameTranslated;
    }

    /**
     * @param string|null $nameTranslated
     * @return SongCategory
     */
    public function setNameTranslated(?string $nameTranslated): SongCategory
    {
        $this->nameTranslated = $nameTranslated;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortKey(): ?string
    {
        return $this->sortKey;
    }

    /**
     * @param string|null $sortKey
     * @return SongCategory
     */
    public function setSortKey(?string $sortKey): SongCategory
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCampusId(): ?string
    {
        return $this->campusId;
    }

    /**
     * @param string|null $campusId
     * @return SongCategory
     */
    public function setCampusId(?string $campusId): SongCategory
    {
        $this->campusId = $campusId;
        return $this;
    }

}