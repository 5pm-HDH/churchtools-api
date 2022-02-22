<?php


namespace Tests\Unit\Docs;


use CTApi\Models\Person;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCreateModelFromData()
    {
        $data = [
            "id" => 21,
            "firstName" => "Joe",
            "lastName" => "Kling",
            //...
        ];

        $person = Person::createModelFromData($data);
    }

    public function testCreateModelsFromArray()
    {
        $dataPersons = [
            ["id" => 21, "firstName" => "Joe", "lastName" => "Kling", /*...*/],
            ["id" => 22, "firstName" => "Dieter", "lastName" => "Maier", /*...*/]
        ];

        $personArray = Person::createModelsFromArray($dataPersons);

        $lastNames = "";
        foreach($personArray as $person){
            $lastNames .= $person->getLastName() . "/ ";
        }
        $this->assertEquals("Kling/ Maier/ ", $lastNames);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testGetterAndSetter(){
        $person = new Person();

        $person->getLastName();
        $person->setLastName("Joe");
    }
}