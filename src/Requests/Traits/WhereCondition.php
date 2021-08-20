<?php


namespace CTApi\Requests\Traits;

use CTApi\Exceptions\CTRequestException;

trait WhereCondition
{
    private array $whereCriteria = [];

    public function where(string $key, $value): self
    {
        if (array_key_exists($key, $this->whereCriteria)) {
            throw new CTRequestException("Where '" . $key . "' already used." .
                " You cannot append the same where clause on a single Request.");
        }
        $this->whereCriteria[$key] = $value;
        return $this;
    }

    protected function addWhereConditionsToOption(&$options): void
    {
        if (!array_key_exists("json", $options)) {
            $options["json"] = [];
        }

        foreach ($this->whereCriteria as $whereKey => $whereValue) {
            $options["json"][$whereKey] = $whereValue;
        }
    }
}