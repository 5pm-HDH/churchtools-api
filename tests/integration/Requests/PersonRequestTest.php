<?php

namespace Tests\Integration\Requests;

use CTApi\CTConfig;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Event;
use CTApi\Models\Group;
use CTApi\Models\Person;
use CTApi\Models\PersonGroup;
use CTApi\Requests\PersonRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class PersonRequestTest extends TestCaseAuthenticated
{
    public function testWhoAmI(): void
    {
        $person = PersonRequest::whoami();

        $this->assertEquals(IntegrationTestData::getResult("whoami", "first_name"), $person->getFirstName());
        $this->assertEquals(IntegrationTestData::getResult("whoami", "last_name"), $person->getLastName());
    }

    public function testFindOrFail(): void
    {
        CTConfig::enableDebugging();
        $userData = IntegrationTestData::get()->getUserData();
        $id = $userData["id"];

        $person = PersonRequest::find($id);
        $this->assertNotNull($person);
        $this->assertEquals(IntegrationTestData::getResult("whoami", "first_name"), $person->getFirstName());

        $noPerson = PersonRequest::find(0);
        $this->assertNull($noPerson);

        $exceptionThrown = false;
        try {
            PersonRequest::findOrFail(0);
        } catch (CTRequestException) {
            $exceptionThrown = true;
        }
        $this->assertTrue($exceptionThrown);
    }

    public function testAll(): void
    {
        $allPersons = PersonRequest::all();
        $this->assertInstanceOf(Person::class, $allPersons[0]);
    }

    public function testWhere(): void
    {
        $selectedPersons = PersonRequest::where('ids', IntegrationTestData::getFilter("filter_persons", "ids"))->get();
        print_r($selectedPersons);
        $this->assertEquals(sizeof($selectedPersons), IntegrationTestData::getResult("filter_persons", "number_of_elements"));
    }

    public function testOrderBy(): void
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

    public function testRequestEvents(): void
    {
        $person = PersonRequest::whoami();

        $requestEventBuilder = $person->requestEvents();
        $this->assertNotNull($requestEventBuilder);
        $events = $requestEventBuilder->get();
        $this->assertTrue(sizeof($events) > 0);
        foreach ($events as $event) {
            $this->assertInstanceOf(Event::class, $event);
        }
    }

    public function testRequestGroups(): void
    {
        $person = PersonRequest::whoami();

        $groupRequestBuilder = $person->requestGroups();
        $this->assertNotNull($groupRequestBuilder);
        $groups = $groupRequestBuilder->get();

        $this->assertFalse(empty($groups));
        foreach ($groups as $group) {
            $this->assertInstanceOf(PersonGroup::class, $group);
            $this->assertInstanceOf(Group::class, $group->getGroup());
            $this->assertInstanceOf(Group::class, $group->requestGroup());
        }
    }
}
