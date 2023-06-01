<?php


namespace Models;


use CTApi\Models\AbstractModel;
use CTApi\Models\Traits\FillWithData;

class DBField extends AbstractModel
{
    use FillWithData;

    protected ?string $key = null;
    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $column = null;
    protected ?string $shorty = null;
    protected ?string $fieldCategoryCode = null;
    protected ?string $fieldTypeCode = null;
    protected ?string $fieldTypeId = null;
    protected ?string $isActive = null;
    protected ?bool $isNewPersonField = null;
    protected ?string $lineEnding = null;
    protected ?int $secLevel = null;
    protected ?int $length = null;
    protected ?int $sortKey = null;
    protected ?bool $deleteOnArchive = null;
    protected ?bool $nullable = null;
    protected ?bool $hideInFrontend = null;
    protected ?bool $isBasicInfo = null;
    protected array $options = [];


    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return mixed
     */
    public function setId(?string $id): DBField
    {
        $this->id = $id;
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
     * @return DBField
     */
    public function setKey(?string $key): DBField
    {
        $this->key = $key;
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
     * @return DBField
     */
    public function setName(?string $name): DBField
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
     * @return DBField
     */
    public function setNameTranslated(?string $nameTranslated): DBField
    {
        $this->nameTranslated = $nameTranslated;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColumn(): ?string
    {
        return $this->column;
    }

    /**
     * @param string|null $column
     * @return DBField
     */
    public function setColumn(?string $column): DBField
    {
        $this->column = $column;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShorty(): ?string
    {
        return $this->shorty;
    }

    /**
     * @param string|null $shorty
     * @return DBField
     */
    public function setShorty(?string $shorty): DBField
    {
        $this->shorty = $shorty;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldCategoryCode(): ?string
    {
        return $this->fieldCategoryCode;
    }

    /**
     * @param string|null $fieldCategoryCode
     * @return DBField
     */
    public function setFieldCategoryCode(?string $fieldCategoryCode): DBField
    {
        $this->fieldCategoryCode = $fieldCategoryCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldTypeCode(): ?string
    {
        return $this->fieldTypeCode;
    }

    /**
     * @param string|null $fieldTypeCode
     * @return DBField
     */
    public function setFieldTypeCode(?string $fieldTypeCode): DBField
    {
        $this->fieldTypeCode = $fieldTypeCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldTypeId(): ?string
    {
        return $this->fieldTypeId;
    }

    /**
     * @param string|null $fieldTypeId
     * @return DBField
     */
    public function setFieldTypeId(?string $fieldTypeId): DBField
    {
        $this->fieldTypeId = $fieldTypeId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsActive(): ?string
    {
        return $this->isActive;
    }

    /**
     * @param string|null $isActive
     * @return DBField
     */
    public function setIsActive(?string $isActive): DBField
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsNewPersonField(): ?bool
    {
        return $this->isNewPersonField;
    }

    /**
     * @param bool|null $isNewPersonField
     * @return DBField
     */
    public function setIsNewPersonField(?bool $isNewPersonField): DBField
    {
        $this->isNewPersonField = $isNewPersonField;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLineEnding(): ?string
    {
        return $this->lineEnding;
    }

    /**
     * @param string|null $lineEnding
     * @return DBField
     */
    public function setLineEnding(?string $lineEnding): DBField
    {
        $this->lineEnding = $lineEnding;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSecLevel(): ?int
    {
        return $this->secLevel;
    }

    /**
     * @param int|null $secLevel
     * @return DBField
     */
    public function setSecLevel(?int $secLevel): DBField
    {
        $this->secLevel = $secLevel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     * @return DBField
     */
    public function setLength(?int $length): DBField
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortKey(): ?int
    {
        return $this->sortKey;
    }

    /**
     * @param int|null $sortKey
     * @return DBField
     */
    public function setSortKey(?int $sortKey): DBField
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDeleteOnArchive(): ?bool
    {
        return $this->deleteOnArchive;
    }

    /**
     * @param bool|null $deleteOnArchive
     * @return DBField
     */
    public function setDeleteOnArchive(?bool $deleteOnArchive): DBField
    {
        $this->deleteOnArchive = $deleteOnArchive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNullable(): ?bool
    {
        return $this->nullable;
    }

    /**
     * @param bool|null $nullable
     * @return DBField
     */
    public function setNullable(?bool $nullable): DBField
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getHideInFrontend(): ?bool
    {
        return $this->hideInFrontend;
    }

    /**
     * @param bool|null $hideInFrontend
     * @return DBField
     */
    public function setHideInFrontend(?bool $hideInFrontend): DBField
    {
        $this->hideInFrontend = $hideInFrontend;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsBasicInfo(): ?bool
    {
        return $this->isBasicInfo;
    }

    /**
     * @param bool|null $isBasicInfo
     * @return DBField
     */
    public function setIsBasicInfo(?bool $isBasicInfo): DBField
    {
        $this->isBasicInfo = $isBasicInfo;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return DBField
     */
    public function setOptions(array $options): DBField
    {
        $this->options = $options;
        return $this;
    }
}