<?php


namespace CTApi\Models;


use CTApi\Models\AbstractModel;
use CTApi\Models\Traits\FillWithData;

class DBFieldCategory extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $internCode = null;
    protected ?string $table = null;

    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return DBFieldCategory
     */
    public function setId(?string $id): DBFieldCategory
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
     * @return DBFieldCategory
     */
    public function setName(?string $name): DBFieldCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInternCode(): ?string
    {
        return $this->internCode;
    }

    /**
     * @param string|null $internCode
     * @return DBFieldCategory
     */
    public function setInternCode(?string $internCode): DBFieldCategory
    {
        $this->internCode = $internCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * @param string|null $table
     * @return DBFieldCategory
     */
    public function setTable(?string $table): DBFieldCategory
    {
        $this->table = $table;
        return $this;
    }
}