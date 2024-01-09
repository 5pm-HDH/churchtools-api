<?php

namespace CTApi\Models\Common\DBField;

use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;

class DBField extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $key = null;
    protected ?string $useAsPlaceholder = null;
    protected ?string $nameTranslated = null;
    protected ?string $shorty = null;
    protected ?string $column = null;
    protected ?int $length = null;

    protected ?DBFieldCategory $fieldCategory = null;
    protected ?DBFieldType $fieldType = null;

    protected ?bool $isActive = null;
    protected ?bool $isNewPersonField = null;
    protected ?string $lineEnding = null;
    protected ?int $securityLevel = null;
    protected ?int $sortKey = null;
    protected ?bool $deleteOnArchive = null;
    protected ?bool $nullable = null;
    protected ?bool $hideInFrontend = null;
    protected ?bool $notConfigurable = null;
    protected ?bool $isBasicInfo = null;
    protected array $options = [];


    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "fieldCategoryCode":
                if ($this->fieldCategory == null) {
                    $this->fieldCategory = new DBFieldCategory();
                }
                $this->fieldCategory->setInternCode($value);
                break;
            case "fieldTypeCode":
                if ($this->fieldType == null) {
                    $this->fieldType = new DBFieldType();
                }
                $this->fieldType->setInternCode($value);
                break;
            case "fieldTypeId":
                if ($this->fieldType == null) {
                    $this->fieldType = new DBFieldType();
                }
                $this->fieldType->setId($value);
                break;
            case "secLevel":
                $this->securityLevel = $value;
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "fieldCategory":
                $this->fieldCategory = DBFieldCategory::createModelFromData($data);
                break;
            case "fieldType":
                $this->fieldType = DBFieldType::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }


    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return DBField
     */
    public function setId(?string $id): DBField
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
     * @return DBFieldCategory|null
     */
    public function getFieldCategory(): ?DBFieldCategory
    {
        return $this->fieldCategory;
    }

    /**
     * @param DBFieldCategory|null $fieldCategory
     * @return DBField
     */
    public function setFieldCategory(?DBFieldCategory $fieldCategory): DBField
    {
        $this->fieldCategory = $fieldCategory;
        return $this;
    }

    /**
     * @return DBFieldType|null
     */
    public function getFieldType(): ?DBFieldType
    {
        return $this->fieldType;
    }

    /**
     * @param DBFieldType|null $fieldType
     * @return DBField
     */
    public function setFieldType(?DBFieldType $fieldType): DBField
    {
        $this->fieldType = $fieldType;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     * @return DBField
     */
    public function setIsActive(?bool $isActive): DBField
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNotConfigurable(): ?bool
    {
        return $this->notConfigurable;
    }

    /**
     * @param bool|null $notConfigurable
     * @return DBField
     */
    public function setNotConfigurable(?bool $notConfigurable): DBField
    {
        $this->notConfigurable = $notConfigurable;
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
    public function getSecurityLevel(): ?int
    {
        return $this->securityLevel;
    }

    /**
     * @param int|null $securityLevel
     * @return DBField
     */
    public function setSecurityLevel(?int $securityLevel): DBField
    {
        $this->securityLevel = $securityLevel;
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

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): DBField
    {
        $this->key = $key;
        return $this;
    }

    public function getUseAsPlaceholder(): ?string
    {
        return $this->useAsPlaceholder;
    }

    public function setUseAsPlaceholder(?string $useAsPlaceholder): DBField
    {
        $this->useAsPlaceholder = $useAsPlaceholder;
        return $this;
    }
}
