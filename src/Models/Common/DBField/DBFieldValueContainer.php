<?php


namespace CTApi\Models\Common\DBField;


class DBFieldValueContainer
{

    public function __construct(
        private string $dbFieldKey,
        private $dbFieldValue,
        private ?DBField $DBField
    )
    {
    }

    /**
     * @return string
     */
    public function getDBFieldKey(): string
    {
        return $this->dbFieldKey;
    }

    /**
     * @param string $dbFieldKey
     * @return DBFieldValueContainer
     */
    public function setDBFieldKey(string $dbFieldKey): DBFieldValueContainer
    {
        $this->dbFieldKey = $dbFieldKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDBFieldValue()
    {
        return $this->dbFieldValue;
    }

    /**
     * @param mixed $dbFieldValue
     * @return DBFieldValueContainer
     */
    public function setDBFieldValue($dbFieldValue)
    {
        $this->dbFieldValue = $dbFieldValue;
        return $this;
    }

    /**
     * @return DBField|null
     */
    public function getDBField(): ?DBField
    {
        return $this->DBField;
    }

    /**
     * @param DBField|null $DBField
     * @return DBFieldValueContainer
     */
    public function setDBField(?DBField $DBField): DBFieldValueContainer
    {
        $this->DBField = $DBField;
        return $this;
    }
}