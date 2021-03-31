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
            PersonRequest::findOrFail(0);
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

    public function testWhere()
    {
        $selectedPersons = PersonRequest::where('ids', [4463, 616, 474, 99999])->get();

        $this->assertTrue(sizeof($selectedPersons) <= 4);
    }
}