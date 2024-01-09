<?php

namespace CTApi\Test\Unit\Models;

use CTApi\Exceptions\CTModelException;
use CTApi\Models\AbstractModel;
use CTApi\Traits\Model\FillWithData;
use PHPUnit\Framework\TestCase;

class AbstractModelTest extends TestCase
{
    public function testCreateModel()
    {
        $car = CarModel::createModelFromData([
            "id" => 21,
            "name" => "Skoda Fabia"
        ]);

        $this->assertEquals("21", $car->getId());
        $this->assertEquals("21", $car->getIdOrFail());
        $this->assertEquals(21, $car->getIdAsInteger());
        $this->assertEquals("Skoda Fabia", $car->getName());
    }

    public function testSetter()
    {
        $car = (new CarModel())->setName("Fiat Panda")->setId("21");

        $this->assertEquals("21", $car->getId());
        $this->assertEquals("21", $car->getIdOrFail());
        $this->assertEquals(21, $car->getIdAsInteger());
        $this->assertEquals("Fiat Panda", $car->getName());
    }

    public function testCreateModelWithoutId()
    {
        $carWithoutId = CarModel::createModelFromData([
            "name" => "Audi A8"
        ]);

        $this->assertEquals("Audi A8", $carWithoutId->getName());
        $this->assertNull($carWithoutId->getId());

        $this->expectException(CTModelException::class);
        $carWithoutId->getIdOrFail();
    }

    public function testCastIntegerOfNull()
    {
        $carWithoutId = CarModel::createModelFromData([
            "name" => "Audi A8"
        ]);

        $this->expectException(CTModelException::class);
        $carWithoutId->getIdAsInteger();
    }

    public function testCreateNonnumericId()
    {
        $carNonumericId = CarModel::createModelFromData([
            "name" => "Audi A8",
            "id" => "GUID:21"
        ]);

        $this->expectException(CTModelException::class);
        $carNonumericId->getIdAsInteger();
    }
}

class CarModel extends AbstractModel
{
    use FillWithData;

    protected ?string $name = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return CarModel
     */
    public function setName(?string $name): CarModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $id
     * @return CarModel
     */
    public function setId(?string $id): CarModel
    {
        $this->id = $id;
        return $this;
    }
}
