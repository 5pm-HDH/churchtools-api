<?php


namespace Tests\Unit\Requests;


use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Person;
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
}