<?php

namespace CTApi\Models\Common\Tag;

use CTApi\Models\AbstractModel;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class Tag extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $modifiedAt = null;
    protected ?string $modifiedBy = null;
    protected ?string $count = null;

    public function requestModifier(): ?Person
    {
        if ($this->modifiedBy != null) {
            return PersonRequest::find((int)$this->modifiedBy);
        }
        return null;
    }

    /**
     * @param string|null $id
     * @return Tag
     */
    public function setId(?string $id): Tag
    {
        $this->id = $id;
        return $this;
    }

    public function getModifiedAtAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->modifiedAt);
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
     * @return Tag
     */
    public function setName(?string $name): Tag
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModifiedAt(): ?string
    {
        return $this->modifiedAt;
    }

    /**
     * @param string|null $modifiedAt
     * @return Tag
     */
    public function setModifiedAt(?string $modifiedAt): Tag
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModifiedBy(): ?string
    {
        return $this->modifiedBy;
    }

    /**
     * @param string|null $modifiedBy
     * @return Tag
     */
    public function setModifiedBy(?string $modifiedBy): Tag
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCount(): ?string
    {
        return $this->count;
    }

    /**
     * @param string|null $count
     * @return Tag
     */
    public function setCount(?string $count): Tag
    {
        $this->count = $count;
        return $this;
    }
}
