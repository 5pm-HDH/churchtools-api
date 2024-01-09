<?php

namespace CTApi\Test\Unit\Requests;

use CTApi\CTClient;
use CTApi\Exceptions\CTModelException;
use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class PersonRequestBuilderDeleteTest extends TestCaseHttpMocked
{
    public function testDelete()
    {
        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
        ]);

        PersonRequest::delete($person);

        $client = CTClient::getClient();
        $this->assertRequestCallExists("DELETE", "/api/persons/777");
    }

    public function testDeleteWithoutId()
    {
        $this->expectException(CTModelException::class);
        $person = new Person();
        PersonRequest::delete($person);
    }
}
