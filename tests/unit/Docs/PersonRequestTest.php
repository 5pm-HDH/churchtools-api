<?php


namespace Tests\Unit\Docs;


use CTApi\Requests\PersonRequest;
use Tests\Unit\TestCaseHttpMocked;

class PersonRequestTest extends TestCaseHttpMocked
{

    public function testExampleCode()
    {
        // logged in user
        $myself = PersonRequest::whoami();

        $this->assertEquals("Logged in Person: Matthew Evangelist", "Logged in Person: " . $myself->getFirstName() . " " . $myself->getLastName());

        // Get specific Person
        $personA = PersonRequest::find(21);     // returns "null" if id is invalid
        $personB = PersonRequest::findOrFail(22); // throws exception if id is invalid

        // request all users
        $allPersons = PersonRequest::all();
        $personList = "";
        foreach ($allPersons as $person) {
            $personList .= $person->getFirstName() . ", ";
        }
        $this->assertEquals("Matthew, Mark, Luke, John, ", $personList);

        // filter user
        $teenager = PersonRequest::where('birthday_before', '2007-01-01')
            ->where('birthday_after', '2003-01-01')
            ->orderBy('birthday')
            ->get();

        // Request Event of Person
        $personA = PersonRequest::whoami();
        $events = $personA->requestEvents()->get();
    }
}