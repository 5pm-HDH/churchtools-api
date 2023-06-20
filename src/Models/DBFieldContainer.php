<?php


namespace CTApi\Models;


use CTApi\Models\AbstractModel;
use CTApi\Models\Traits\FillWithData;

class DBFieldContainer extends AbstractModel
{
    use FillWithData;

    protected ?int $groupId = null;
    protected ?DBField $dbField = null;

    protected function fillArrayType(string $key, array $data): void
    {
        if($key == "dbField"){
            $this->dbField = DBField::createModelFromData($data);
        }else{
            $this->fillDefault($key, $data);
        }
    }

    /**
     * Fluent setter have to be implemented by child-class. Returns instance of model.
     * @param string|null $id
     * @return DBFieldContainer
     */
    public function setId(?string $id): DBFieldContainer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     * @return DBFieldContainer
     */
    public function setGroupId(?int $groupId): DBFieldContainer
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return DBField|null
     */
    public function getDbField(): ?DBField
    {
        return $this->dbField;
    }

    /**
     * @param DBField|null $dbField
     * @return DBFieldContainer
     */
    public function setDbField(?DBField $dbField): DBFieldContainer
    {
        $this->dbField = $dbField;
        return $this;
    }
}