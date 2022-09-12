<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\PersonRequest;

class Tag
{
    use FillWithData;

    protected ?string $id;
    protected ?string $name;
    protected ?string $modifiedAt;
    protected ?string $modifiedBy;
    protected ?string $count;

    public function requestModifier(): ?Person
    {
        if ($this->modifiedBy != null) {
            return PersonRequest::find((int)$this->modifiedBy);
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
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