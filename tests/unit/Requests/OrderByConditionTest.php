<?php

namespace Tests\Unit\Requests;

use CTApi\Exceptions\CTRequestException;
use CTApi\Requests\Traits\OrderByCondition;
use PHPUnit\Framework\TestCase;

class OrderByConditionTest extends TestCase
{

    protected RequestBuilder $exampleRequestBuilder;
    protected array $data = [
        ["id" => 21, "name" => "Joe", "tags" => [21, 23, 42]],
        ["id" => 3, "name" => "Sam", "tags" => [39]],
        ["id" => 50, "name" => "Joe", "tags" => []],
        ["id" => 3, "name" => "Xaver", "tags" => [192, 923, 9328, 392]],
    ];

    protected array $criticData = [
        ["id" => null, "name" => 291, "tags" => "21, 23, 42"],
        ["id" => 3, "name" => "Sam", "tags" => [39]],
        ["id" => "5", "name" => null, "tags" => null],
        ["id" => 30, "name" => "Xaver", "tags" => [192, 923, 9328, 392]],
    ];

    protected array $inconsistentKeys = [
        ["id" => 2],
        ["id" => 21],
        [],
        ["id" => 23]
    ];


    protected function setUp(): void
    {
        $this->clearSortingCriteria();
    }

    private function clearSortingCriteria(): void
    {
        $this->exampleRequestBuilder = new RequestBuilder();
    }

    public function testNumericSort(): void
    {
        $this->exampleRequestBuilder->orderBy('id');

        $this->exampleRequestBuilder->orderMyData($this->data);
        $this->assertEquals(3, $this->data[0]['id']);

        $this->clearSortingCriteria();

        $this->exampleRequestBuilder->orderBy('id', false);
        $this->exampleRequestBuilder->orderMyData($this->data);
        $this->assertEquals(50, $this->data[0]['id']);
    }

    public function testStringSort(): void
    {
        $this->exampleRequestBuilder->orderBy('name');

        $this->exampleRequestBuilder->orderMyData($this->data);
        $this->assertEquals("Joe", $this->data[0]['name']);

        $this->clearSortingCriteria();

        $this->exampleRequestBuilder->orderBy('name', false);
        $this->exampleRequestBuilder->orderMyData($this->data);
        $this->assertEquals("Xaver", $this->data[0]['name']);
    }

    public function testTwoStepSearch(): void
    {
        //First sort id --> then Sort Name
        $this->exampleRequestBuilder->orderBy('id')->orderBy('name');

        $this->exampleRequestBuilder->orderMyData($this->data);

        $this->assertEquals(21, $this->data[0]['id']);
        $this->assertEquals("Joe", $this->data[0]['name']);

        $this->clearSortingCriteria();

        //First sort for Name -> then Sort Id
        $this->exampleRequestBuilder->orderBy('name')->orderBy('id');

        $this->exampleRequestBuilder->orderMyData($this->data);

        $this->assertEquals(3, $this->data[0]['id']);
        $this->assertEquals("Sam", $this->data[0]['name']);


    }

    public function testInvalidSort(): void
    {
        $this->exampleRequestBuilder->orderBy('id', false);
        $this->exampleRequestBuilder->orderMyData($this->criticData);

        $this->assertEquals(5, $this->criticData[0]['id']);
    }

    public function testInconsistentKeys(): void
    {
        $this->exampleRequestBuilder->orderBy('id');
        $this->expectException(CTRequestException::class);
        $this->exampleRequestBuilder->orderMyData($this->inconsistentKeys);
    }

    public function testInvalidKey(): void
    {
        $this->exampleRequestBuilder->orderBy('invalidKeyBecauseItDoesNotExist');
        $this->expectException(CTRequestException::class);
        $this->exampleRequestBuilder->orderMyData($this->data);
    }
}


class RequestBuilder
{
    use OrderByCondition;

    public function orderMyData(&$data): void
    {
        $this->orderRawData($data);
    }
}