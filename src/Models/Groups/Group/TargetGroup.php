<?php

namespace CTApi\Models\Groups\Group;

use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;

class TargetGroup extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;

    /**
     * @param string|null $id
     * @return TargetGroup
     */
    public function setId(?string $id): TargetGroup
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
     * @return TargetGroup
     */
    public function setName(?string $name): TargetGroup
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
     * @return TargetGroup
     */
    public function setNameTranslated(?string $nameTranslated): TargetGroup
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
     * @return TargetGroup
     */
    public function setSortKey(?string $sortKey): TargetGroup
    {
        $this->sortKey = $sortKey;
        return $this;
    }
}
