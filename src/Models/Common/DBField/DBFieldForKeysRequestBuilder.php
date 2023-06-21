<?php


namespace CTApi\Models\Common\DBField;


class DBFieldForKeysRequestBuilder
{
    private array $allDBFields = [];

    /**
     * DBFieldForKeysRequestBuilder constructor.
     * @param array $dbFieldData key is DBFieldKey and value is value.
     */
    public function __construct(
        private array $dbFieldData
    )
    {
    }

    public function get(): array
    {
        $this->allDBFields = DBFieldRequest::all();

        $dbFieldValueContainers = [];

        foreach ($this->dbFieldData as $dbKey => $dbValue) {
            $dbFieldValueContainers[] = new DBFieldValueContainer(
                $dbKey,
                $dbValue,
                $this->findDBField($dbKey)
            );
        }
        return $dbFieldValueContainers;
    }

    private function findDBField(string $dbFieldKey): ?DBField
    {
        foreach ($this->allDBFields as $dbField) {
            if ($dbField->getColumn() == $dbFieldKey) {
                return $dbField;
            }
        }
        return null;
    }
}
