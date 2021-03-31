<?php


namespace CTApi\Requests\Traits;

trait WhereCondition
{
    private array $whereCriteria = [];

    public function where(string $key, $value): self
    {
        $this->whereCriteria[$key] = $value;
        return $this;
    }

    private function addWhereConditionsToOption(&$options): void
    {
        if (!array_key_exists("json", $options)) {
            $options["json"] = [];
        }

        foreach ($this->whereCriteria as $whereKey => $whereValue) {
            $options["json"][$whereKey] = $whereValue;
        }
    }
}