<?php

namespace CTApi\Test\Integration;

use CTApi\Utils\CTUtil;

class IntegrationTestCase
{
    public function __construct(private string $testCase,
        private array $data) {
    }

    public function getFilter(string $filterPath)
    {
        if(!array_key_exists("filter", $this->data)) {
            throw new \Exception("Could not find filter for test case: " . $this->testCase);
        }
        return CTUtil::arrayPathGet($this->data["filter"], $filterPath);
    }

    public function getFilterAsInt(string $filterPath): int
    {
        $value = $this->getFilter($filterPath);
        if($value === null) {
            throw new \Exception("Cannot convert null to int");
        }
        return (int) $value;
    }

    public function getResult(string $resultPath)
    {
        if(!array_key_exists("result", $this->data)) {
            throw new \Exception("Could not find results for test case: " . $this->testCase);
        }
        return CTUtil::arrayPathGet($this->data["result"], $resultPath);
    }

    public function getResultAsInt(string $resultPath): int
    {
        $value = $this->getResult($resultPath);
        if($value === null) {
            throw new \Exception("Cannot convert null to int");
        }
        return (int) $value;
    }
}
