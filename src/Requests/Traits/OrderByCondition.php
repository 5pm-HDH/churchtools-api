<?php


namespace CTApi\Requests\Traits;


use CTApi\Exceptions\CTRequestException;

trait OrderByCondition
{
    private array $orderCriteria = [];

    public function orderBy(string $key, $sortAscending = true): self
    {
        array_push($this->orderCriteria, [
            "key" => $key,
            "sortAscending" => boolval($sortAscending)
        ]);
        return $this;
    }

    public function orderRawData(&$data): void
    {
        foreach ($this->orderCriteria as $criteria) {
            $key = $criteria['key'];
            $sortAscending = $criteria['sortAscending'];

            usort($data, function ($recordA, $recordB) use ($key, $sortAscending) {
                if (!array_key_exists($key, $recordA) || !array_key_exists($key, $recordB)) {
                    throw new CTRequestException("Could not sort data by key: " . $key);
                }

                $valueA = $recordA[$key];
                $valueB = $recordB[$key];

                if (is_numeric($valueA) && is_numeric($valueB)) {
                    if ($sortAscending) {
                        return $valueA > $valueB;
                    } else {
                        return $valueB > $valueA;
                    }
                } else if (is_string($valueA) || is_string($valueB)) {
                    if ($sortAscending) {
                        return strcmp($valueA, $valueB);
                    } else {
                        return strcmp($valueB, $valueA);
                    }
                } else {
                    return 0;
                }
            });
        }
    }
}