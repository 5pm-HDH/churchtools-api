<?php

namespace Tests\Unit\Models;

use CTApi\Models\Traits\FillWithData;
use PHPUnit\Framework\TestCase;

class FillWithDataTraitTest extends TestCase
{

    const DATA_CONTAINER = [
        'id' => 21,
        'name' => "Robin Hood",
        'age' => 32
    ];

    const DATA_LIST = [
        ['id' => 22, 'name' => "Big James", 'age' => 94],
        ['id' => 23, 'name' => "Little John", 'age' => 23],
        ['id' => 24, 'name' => "Joe", 'age' => 32],
    ];

    public function testCreateFromDataContainer()
    {
        $model = ModelMock::createModelFromData(self::DATA_CONTAINER);
        $this->assertDataContainerIsValid($model);

        $arrayWithModels = ModelMock::createModelsFromArray(self::DATA_CONTAINER);
        $this->assertIsArray($arrayWithModels);
        $this->assertDataContainerIsValid($arrayWithModels[0]);
    }

    private function assertDataContainerIsValid(ModelMock $model)
    {
        $this->assertModelEqualsData($model, self::DATA_CONTAINER);
    }

    private function assertModelEqualsData(ModelMock $model, array $container)
    {
        $this->assertEquals($model->id, $container['id']);
        $this->assertEquals($model->name, $container['name']);
        /**
         * @psalm-suppress UndefinedPropertyFetch
         * Age Attribute will be added in "createModelFromData"-Method
         */
        $this->assertEquals($model->age, $container['age']);
    }

    public function testCreateFromDataList()
    {
        $modelArray = ModelMock::createModelsFromArray(self::DATA_LIST);
        $this->assertDataListIsValid($modelArray);

        $firstModel = ModelMock::createModelFromData(self::DATA_LIST);
        $this->assertModelEqualsData($firstModel, self::DATA_LIST[0]);
    }

    private function assertDataListIsValid(array $modelArray)
    {
        $this->assertModelEqualsData($modelArray[0], self::DATA_LIST[0]);
        $this->assertModelEqualsData($modelArray[1], self::DATA_LIST[1]);
        $this->assertModelEqualsData($modelArray[2], self::DATA_LIST[2]);
    }

}

class ModelMock
{
    use FillWithData;

    public int $id;
    public string $name;
}