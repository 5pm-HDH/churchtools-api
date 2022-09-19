<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupCategory extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;

    /**
     * @param string|null $id
     * @return GroupCategory
     */
    public function setId(?string $id): GroupCategory
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
     * @return GroupCategory
     */
    public function setName(?string $name): GroupCategory
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
     * @return GroupCategory
     */
    public function setNameTranslated(?string $nameTranslated): GroupCategory
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
     * @return GroupCategory
     */
    public function setSortKey(?string $sortKey): GroupCategory
    {
        $this->sortKey = $sortKey;
        return $this;
    }
}