<?php

namespace CTApi\Traits\Model;

use CTApi\Models\Common\DBField\DBFieldForKeysRequestBuilder;

trait HasDBFields
{
    private array $dbFieldData = [];

    protected function appendDBField(string $dbFieldKey, $value)
    {
        $this->dbFieldData[$dbFieldKey] = $value;
    }

    private function setDBFieldData(array $dbFieldData)
    {
        $this->dbFieldData = $dbFieldData;
    }

    public function getDBFieldData(): array
    {
        return $this->dbFieldData;
    }

    public function getDBFieldKeys(): array
    {
        return array_keys($this->getDBFieldData());
    }

    public function requestDBFields(): DBFieldForKeysRequestBuilder
    {
        return new DBFieldForKeysRequestBuilder($this->getDBFieldData());
    }
}
