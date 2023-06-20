<?php


namespace CTApi\Models;


use CTApi\Models\AbstractModel;
use CTApi\Models\Traits\FillWithData;

class DBFieldType extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $internCode = null;

    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return mixed
     */
    public function setId(?string $id): DBFieldType
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
     * @return DBFieldType
     */
    public function setName(?string $name): DBFieldType
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
     * @return DBFieldType
     */
    public function setInternCode(?string $internCode): DBFieldType
    {
        $this->internCode = $internCode;
        return $this;
    }
}