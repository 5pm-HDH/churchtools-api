<?php


namespace unit\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\HasDBFields;
use PHPUnit\Framework\TestCase;

class DBFieldsTraitTest extends TestCase
{
    public function testCar()
    {
        // Without DBFields
        $car = Car::createModelFromData([
            "color" => "red",
            "driver" => "Charles"
        ]);
        $carData = $car->toData();
        $this->assertEquals(["color" => "red"], $carData);

        // With DBFields
        $carWithDBFields = CarWithDBFields::createModelFromData([
            "color" => "red",
            "driver" => "Charles"
        ]);

        $this->assertEquals(["color" => "red", "driver" => "Charles"], $carWithDBFields->toData());
        $this->assertEquals(["driver"], $carWithDBFields->getDBFieldKeys());
        $this->assertEquals(["driver" => "Charles"], $carWithDBFields->getDBFieldData());
    }

    public function testDBFieldsWithArray()
    {
        $data = ["color" => "red", "driver" => ["Charles", "Dieter"]];

        $car = CarWithDBFields::createModelFromData($data);
        $carData = $car->toData();

        $this->assertEquals($data, $carData);
    }

    public function testDBFieldsWithObject()
    {
        $driverData = ["name" => "James", "licenseDate" => "1952-02-41"];
        $data = ["driver" => Driver::createModelFromData($driverData)];
        $expectedData = [
            "color" => null,
            "driver" => $driverData
        ];

        $car = CarWithDBFields::createModelFromData($data);
        $carData = $car->toData();

        $this->assertEquals($expectedData, $carData);
    }
}


class Car
{
    use FillWithData;

    protected ?string $color = null;
}

class CarWithDBFields extends Car
{

    use FillWithData, HasDBFields;
}

class Driver
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $licenseDate = null;

}