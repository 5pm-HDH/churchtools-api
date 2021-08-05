<?php

namespace Tests\Integration\Requests;

use CTApi\Models\Event;
use CTApi\Models\Person;
use CTApi\Requests\AuthRequest;
use CTApi\Requests\PersonRequest;
use Exception;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

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

    public function testOrderBy()
    {
        $personsAsc = PersonRequest::orderBy('firstName')->get();
        $personsDesc = PersonRequest::orderBy('firstName', false)->get();
        $personsDesc2 = PersonRequest::where('ignore', 'ignore')->orderBy('firstName', false)->get();

        $this->assertEquals(sizeof($personsAsc), sizeof($personsDesc));
        $this->assertEquals(sizeof($personsAsc), sizeof($personsDesc2));

        //Sort first name by hand
        $firstNames = array_map(function ($person) {
            return $person->getFirstName();
        }, $personsAsc);
        sort($firstNames);

        $this->assertEquals($firstNames[0], $personsAsc[0]->getFirstName());
        $this->assertEquals(end($firstNames), $personsDesc[0]->getFirstName());
        $this->assertEquals(end($firstNames), $personsDesc2[0]->getFirstName());
    }

    public function testRequestEvents()
    {
        $person = PersonRequest::whoami();

        $events = $person->requestEvents()->get();

        $this->assertIsArray($events);
        foreach ($events as $event) {
            $this->assertInstanceOf(Event::class, $event);
        }

    }
}
