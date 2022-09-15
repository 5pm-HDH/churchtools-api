<?php


namespace Tests\Unit\Docs;


use CTApi\Models\Person;
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

        // Update Avatar: See File-API
        $files = $personA->requestAvatar()?->get() ?? [];
        $avatar = end($files);

        $this->assertEquals("avatar-1.png", $avatar->getName());
        //$personA->requestAvatar()->upload("new-avatar.png");
    }


    /**
     * @doesNotPerformAssertions
     */
    public function testCreatePerson()
    {
        $newPerson = new Person();
        $newPerson->setFirstName("John")
            ->setLastName("Doe")
            ->setBirthName("Smith");
        //add further attributes

        PersonRequest::create($newPerson);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCreatePersonWithEqualName()
    {
        $newPerson = new Person();
        $newPerson->setFirstName("John")
            ->setLastName("Doe")
            ->setBirthday("1970-01-01");
        //add further attributes

        PersonRequest::create($newPerson, force: true);
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
        $this->assertEquals("addressAddition; birthday; birthName; birthplace; campusId; city; country; departmentIds; email; fax; firstName; job; lastName; mobile; nickname; phonePrivate; phoneWork; sexId; statusId; street; zip", $listOfModifiableAttributes);
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

    public function testRequestTags()
    {
        $person = (new Person())->setId("21");

        $tags = $person->requestTags()?->get();

        if ($tags == null) {
            $tags = [];
        }

        $musicDirectorTag = null;
        foreach ($tags as $tag) {
            if ($tag->getName() == "Music Director") {
                $musicDirectorTag = $tag;
            }
        }
        // Tag-Data
        $this->assertEquals(5, $musicDirectorTag?->getId());
        $this->assertEquals("Music Director", $musicDirectorTag?->getName());
        $this->assertEquals(9, $musicDirectorTag?->getCount());

        // Meta-Data
        $this->assertEquals("2021-05-19T06:21:02Z", $musicDirectorTag?->getModifiedAt());
        $this->assertEquals(21, $musicDirectorTag?->getModifiedBy());
        $this->assertEquals("Matthew", $musicDirectorTag?->requestModifier()?->getFirstName());
    }
}