<?php

namespace CTApi\Test\Unit\Models\Collection;

use CTApi\Models\Groups\Group\Group;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\PersonCustomCollection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

    public function testAddCollection()
    {
        $carCollection = new CarCollection();
        $carCollection[] = new Car("mercedes");
        $carCollection->append(new Car("bmw"));
        $carCollection[] = new Car("daimler");

        $this->assertEquals(3, sizeof($carCollection));
    }

    public function testAddCollection_TypeCheck()
    {
        $this->expectException(\InvalidArgumentException::class);
        $carCollection = new CarCollection();
        $carCollection[] = new Car("mercedes");
        $carCollection[] = "awidon";
    }

    public function testCreateCollection()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $carCollection = new CarCollection([$car1, $car2]);
        $this->assertEquals(2, sizeof($carCollection));
    }

    public function testCreateCollection_TypeCheck()
    {
        $this->expectException(\InvalidArgumentException::class);
        $carCollection = new CarCollection(["test"]);
    }

    public function testGetSpecificElement()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $carCollection = new CarCollection([$car1, $car2]);

        $car = $carCollection->offsetGet(1);
        $this->assertEquals($car->brand, "bmw");

        $car = $carCollection[0];
        $this->assertEquals($car->brand, "mercedes");
    }

    public function testRemoveElement()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $car3 = new Car("daimler");
        $carCollection = new CarCollection([$car1, $car2, $car3]);

        $carCollection->offsetUnset(1);
        $this->assertEquals(2, sizeof($carCollection));
    }

    public function testRemoveElementInLoop()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $car3 = new Car("daimler");

        $carCollection = new CarCollection([$car1, $car2, $car3]);

        $numberOfIterations = 0;
        foreach($carCollection as $car)
        {
            echo "\n". $car->brand;
            if($car->brand === "bmw"){
                $carCollection->offsetUnset(1);
            }
            $numberOfIterations++;
        }
        $this->assertEquals(3, $numberOfIterations);
    }

    public function testGetFirstElement()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $car3 = new Car("daimler");

        $carCollection = new CarCollection([$car1, $car2, $car3]);

        foreach($carCollection as $carIterator){
            $car = $carCollection->first();
            $this->assertEquals("mercedes", $car->brand);
        }
    }

    public function testGetFirstElement_Empty()
    {
        $carCollection = new CarCollection();
        $this->assertNull($carCollection->first());
    }

    public function testGetFirstElement_FirstUnset()
    {
        $carCollection = new CarCollection([Car::fromBrand("mercedes"), Car::fromBrand("audi")]);
        $this->assertNotNull($carCollection->first());
        $this->assertEquals("mercedes", $carCollection->first()->brand);

        $carCollection->offsetUnset(0);
        $this->assertNotNull($carCollection->first());
        $this->assertEquals("audi", $carCollection->first()->brand);
    }

    public function testFilter()
    {
        $car1 = new Car("mercedes");
        $car2 = new Car("bmw");
        $car3 = new Car("daimler");

        $carCollection = new CarCollection([$car1, $car2, $car3]);


        $carCollectionFiltered = $carCollection->filter(function($test){
            return $test->brand === "bmw";
        });

        $this->assertEquals(sizeof($carCollectionFiltered), 1);
    }

}