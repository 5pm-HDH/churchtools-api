<?php


namespace Tests\Unit\Requests;


use CTApi\Exceptions\CTModelException;
use CTApi\Models\Person;
use CTApi\Models\Traits\ExtractData;
use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\PersonRequest;
use CTApi\Utils\CTUtil;

class PersonRequestBuilderUpdateTest extends \Tests\Unit\TestCaseHttpMocked
{
    public function testUpdate(): void
    {
        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
            'departmentIds' => [1],
        ]);

        PersonRequest::update($person);

        $request = $this->assertRequestCallExists("PATCH", "/api/persons/777");
        $jsonData = CTUtil::arrayPathGet($request, "options.json");

        $this->assertNotNull($jsonData);

        foreach ($person->getModifiableAttributes() as $attribute) {
            // Assert that all Modifiable-Attributes exists
            $this->assertTrue(array_key_exists($attribute, $jsonData));

            // Assert that given in values exists in request
            $value = $jsonData[$attribute];
            switch ($attribute) {
                case "id":
                    $this->assertEquals("777", $value);
                    break;
                case "firstName":
                    $this->assertEquals("Jane", $value);
                    break;
                case "lastName":
                    $this->assertEquals("Mustermann", $value);
                    break;
                case "birthName":
                    $this->assertEquals("Doe", $value);
                    break;
                case "departmentIds":
                    $this->assertEquals([1], $value);
                    break;
                default:
                    $this->assertNull($value);
            }
        }
    }

    public function testUpdateWithReducedAttributes(): void
    {
        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
        ]);

        PersonRequest::update($person, ["firstName"]);

        $request = $this->assertRequestCallExists("PATCH", "/api/persons/777");
        $jsonData = CTUtil::arrayPathGet($request, "options.json");

        $this->assertNotEmpty($jsonData);
        $this->assertArrayHasKey("firstName", $jsonData);
        $this->assertEquals(sizeof($jsonData), 1, "JSON-Data contains more than firstName Attribute.");
    }

    public function testUpdateInvalidModifiedProperty()
    {
        $person = Person::createModelFromData([
            "id" => 21,
            "firstName" => "Joe"
        ]);

        $this->expectException(CTModelException::class);

        PersonRequest::update($person, ["id"]);
        $this->assertRequestCallNotExists("PATCH", "/api/persons/21");
    }

    public function testUpdateNotExistingModifiedProperty()
    {
        $person = Person::createModelFromData([
            "id" => 21,
            "firstName" => "Joe"
        ]);

        $this->expectException(CTModelException::class);

        PersonRequest::update($person, ["notExistingProperty", "notExistingPropertyTheSecond"]);
        $this->assertRequestCallNotExists("PATCH", "/api/persons/21");
    }

    /**
     * Test what happens to Update-Method when the Model has ModifiableAttributes defined, that does not exist as
     * Attributes. For this Test-Case the CarModelMock inherit all methods from the PersonModel-Class. The
     * getModifiableAttributes return the key "numberOfWings", that does not exist as Attribut. The Test now checks
     * that this Fake-Attribute is not send via to the REST-API.
     */
    public function testModelHasInvalidModifiableAttributes()
    {
        $car = CarModelMock::createModelFromData([
            "id" => 82,
            "color" => "red",
            "numberOfDoors" => 4
        ]);

        PersonRequest::update($car);

        $request = $this->assertRequestCallExists("PATCH", "/api/persons/82");
        $jsonData = CTUtil::arrayPathGet($request, "options.json");

        $this->assertEquals(sizeof($jsonData), 1, "Expected only one JSON-Attribut (Color)");
        $this->assertArrayHasKey("color", $jsonData);
        $this->assertEquals($jsonData["color"], "red");
    }
}


class CarModelMock extends Person
{
    use FillWithData, ExtractData;

    protected ?string $color = null;
    protected ?string $brand = null;
    protected ?int $numberOfDoors = null;

    public static function getModifiableAttributes(): array
    {
        return [
            "color",
            "numberOfWings" // illegal modifiable attribute => should be ignored
        ];
    }
}