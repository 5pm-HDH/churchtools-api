<?php


use CTApi\Models\Person;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\PersonRequest;

class PersonRequestTest extends TestCaseAuthenticated
{
    public function testWhoAmI()
    {
        $person = PersonRequest::whoami();

        $this->assertNotNull($person);
        $this->assertEquals(TestData::getValue('AUTH_FIRST_NAME'), $person->getFirstName());

    }

    public function testFindOrFail()
    {
        //we need auth to retrieve userId
        $auth = AuthRequest::authWithEmailAndPassword(
            TestData::getValue("AUTH_EMAIL"),
            TestData::getValue("AUTH_PASSWORD")
        );

        $person = PersonRequest::find($auth->userId);
        $this->assertEquals(TestData::getValue('AUTH_FIRST_NAME'), $person->getFirstName());

        $noPerson = PersonRequest::find(0);
        $this->assertNull($noPerson);

        $exceptionThrown = false;
        try {
            $noPerson = PersonRequest::findOrFail(0);
        } catch (Exception) {
            $exceptionThrown = true;
        }
        $this->assertTrue($exceptionThrown);
    }

    public function testAll()
    {
        $allPersons = PersonRequest::all();

        $this->assertNotNull($allPersons);
        $this->assertInstanceOf(Person::class, $allPersons[0]);
    }
}