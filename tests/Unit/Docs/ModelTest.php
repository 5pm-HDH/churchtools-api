<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Person;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    private $person;

    protected function setUp(): void
    {
        parent::setUp();
        $this->person = Person::createModelFromData([
            "id" => 21,
            "firstName" => "John",
            "lastName" => "Doe",
            "meta" => [
                "createdPerson" => [
                    "firstName" => "Simon"
                ]
            ]
        ]);
    }

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
        foreach ($personArray as $person) {
            $lastNames .= $person->getLastName() . "/ ";
        }
        $this->assertEquals("Kling/ Maier/ ", $lastNames);
    }

    public function testConvertModelToData()
    {
        $data = $this->person->toData();

        $this->assertEquals("John", $data["firstName"]);
        $this->assertEquals("Simon", $data["meta"]["createdPerson"]["firstName"]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testGetterAndSetter()
    {
        $person = new Person();

        $person->getLastName();
        $person->setLastName("Joe");
    }

    public function testGetId()
    {
        // can be null:
        $this->assertEquals("21", $this->person->getId());

        // throws CTModelException if id is null:
        $this->assertEquals("21", $this->person->getIdOrFail());

        // return int or throws CTModelException:
        $this->assertEquals(21, $this->person->getIdAsInteger());
    }
}