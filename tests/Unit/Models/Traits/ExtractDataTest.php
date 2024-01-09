<?php

namespace CTApi\Test\Unit\Models\Traits;

use CTApi\Traits\Model\ExtractData;
use PHPUnit\Framework\TestCase;

class ExtractDataTest extends TestCase
{
    public function testExtractData(): void
    {
        $model = new ModelMock('John', 'Doe', 35);

        $data = $model->extractData();

        $this->assertCount(3, $data);
        $this->assertArrayHasKey('firstName', $data);
        $this->assertArrayHasKey('lastName', $data);
        $this->assertArrayHasKey('age', $data);
        $this->assertSame('John', $data['firstName']);
        $this->assertSame('Doe', $data['lastName']);
        $this->assertSame(35, $data['age']);
    }
}

class ModelMock implements \CTApi\Interfaces\UpdatableModel
{
    use ExtractData;

    private string $firstName;
    protected string $lastName;
    public int $age;

    public static function getModifiableAttributes(): array
    {
        return []; // ignore for model-mock
    }

    public function __construct(string $firstName, string $lastName, int $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }
}
