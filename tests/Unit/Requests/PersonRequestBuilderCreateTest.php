<?php


namespace CTApi\Test\Unit\Requests;


use CTApi\Exceptions\CTModelException;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;
use CTApi\Utils\CTRequest;
use CTApi\Utils\CTResponse;
use CTApi\Utils\CTUtil;
use Psr\Http\Message\ResponseInterface;


class PersonRequestBuilderCreateTest extends TestCaseHttpMocked
{

    public function testIdMustNotBeSet()
    {
        $person = new Person();
        $person->setId("21");
        $person->setFirstName("John");

        $this->expectException(CTModelException::class);
        PersonRequest::create($person);
    }

    public function testOnlyFilledPropertiesAreSent()
    {
        $person = Person::createModelFromData([
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
            'departmentIds' => [1],
        ]);

        PersonRequest::create($person);

        $request = $this->assertRequestCallExists("POST", "/api/persons");
        $jsonData = CTUtil::arrayPathGet($request, "options.json");

        $this->assertNotNull($jsonData);

        foreach ($person->getModifiableAttributes() as $attribute) {
            // ignore attributes that are not in json-data
            if (!array_key_exists($attribute, $jsonData)) {
                continue;
            }

            // Assert that given in values exists in request
            $value = $jsonData[$attribute];
            switch ($attribute) {
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
                    $this->fail("Property " . $attribute . " was sent to create a new person but is filled with null.");
            }
        }
    }

    public function testFillPersonWithReturnedData()
    {
        $this->setClientMock(new ClientMockCreatePerson());

        $person = new Person();
        $person->setFirstName("John")
            ->setLastName("Doe");

        PersonRequest::create($person);

        $this->assertRequestCallExists("POST", "/api/persons");

        // Properties that are filled bevor request
        $this->assertEquals("John", $person->getFirstName());

        // Properties that are filled from POST-Data
        $this->assertEquals("21", $person->getId());
        $this->assertEquals("+49 1582 291829", $person->getPhonePrivate());
        $this->assertEquals("ModifiedDoe", $person->getLastName());
    }
}


final class ClientMockCreatePerson extends \CTApi\Test\Unit\HttpMock\CTClientMock
{

    public function post($uri, array $options = []): ResponseInterface
    {
        parent::post($uri, $options);
        return CTResponse::createFromRequestAndData(
            (new CTRequest()),
            [
                "data" => [
                    "id" => 21,
                    "phonePrivate" => "+49 1582 291829",
                    "lastName" => "ModifiedDoe",
                    "undefinedProperty" => "Undefined Model-Property"
                ]
            ]
        );
    }
}