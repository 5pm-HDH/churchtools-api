<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class AbsenceReason
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return AbsenceReason
     */
    public function setId(?string $id): AbsenceReason
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
     * @return AbsenceReason
     */
    public function setName(?string $name): AbsenceReason
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
     * @return AbsenceReason
     */
    public function setNameTranslated(?string $nameTranslated): AbsenceReason
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
     * @return AbsenceReason
     */
    public function setSortKey(?string $sortKey): AbsenceReason
    {
        $this->sortKey = $sortKey;
        return $this;
    }
}