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
            $personList .= $person->getFirstName() . " / ";
        }
        $this->assertEquals("Matthew / Mark / Luke / John / ", $personList);

        // filter user
        $teenager = PersonRequest::where('birthday_before', '2007-01-01')
            ->where('birthday_after', '2003-01-01')
            ->orderBy('birthday')
            ->get();

        // Request Event of Person
        $personA = PersonRequest::whoami();
        $events = $personA->requestEvents()?->get();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testUpdatePerson()
    {
        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');

        PersonRequest::update($person);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testUpdatePersonSingleAttrbute()
    {
        $person = PersonRequest::findOrFail(21);
        $person->setEmail('new-mail@example.com');
        $person->setJob('This should not be persisted!');

        PersonRequest::update($person, ['email']);
    }

    public function testUpdatePersonModifiableAttributes()
    {
        $person = PersonRequest::findOrFail(21);

        // Attributes that can be updated in ChurchTools-API
        $listOfModifiableAttributes = implode("; ", $person->getModifiableAttributes());
        $this->assertEquals("addressAddition; birthday; birthName; birthplace; city; country; email; fax; firstName; job; lastName; mobile; nickname; phonePrivate; phoneWork; sexId; street; zip", $listOfModifiableAttributes);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDeletePerson()
    {
        $person = PersonRequest::findOrFail(21);

        // delete person on churchtools
        PersonRequest::delete($person);
    }

    public function testBirthdayRequest()
    {
        $birthdayPersons = PersonRequest::birthdays()
            ->where("start_date", "2022-01-01")
            ->where("end_date", "2022-12-31")
            ->where("my_groups", true)
            ->get();

        $lastBirthdayPerson = end($birthdayPersons);

        $this->assertEquals("21", $lastBirthdayPerson->getPerson()?->getId());
        $this->assertEquals("John", $lastBirthdayPerson->getPerson()?->getFirstName());
        $this->assertEquals("Snow", $lastBirthdayPerson->getPerson()?->getLastName());

        $this->assertEquals("1997-03-01", $lastBirthdayPerson->getAnniversaryInitialDate());
        $this->assertEquals("2022-03-01", $lastBirthdayPerson->getAnniversary());
        $this->assertEquals("25", $lastBirthdayPerson->getAge());
    }
}