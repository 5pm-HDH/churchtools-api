<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

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

    public function testPersonProperties()
    {
        $person = PersonRequest::findOrFail(12);

        $this->assertEquals(12, $person->getId());
        $this->assertEquals("BF4AC3A9-2C43-46A5-8AA4-D39D795C26B0", $person->getGuid());
        $this->assertEquals(99999, $person->getSecurityLevelForPerson());
        $this->assertEquals(99999, $person->getEditSecurityLevelForPerson());
        $this->assertEquals("", $person->getTitle());
        $this->assertEquals("David", $person->getFirstName());
        $this->assertEquals("König", $person->getLastName());
        $this->assertEquals("Dave", $person->getNickname());
        $this->assertEquals("Worship-Pastor", $person->getJob());
        $this->assertEquals(null, $person->getStreet());
        $this->assertEquals(null, $person->getAddressAddition());
        $this->assertEquals(null, $person->getZip());
        $this->assertEquals(null, $person->getCity());
        $this->assertEquals(null, $person->getCountry());
        $this->assertEquals(null, $person->getLatitude());
        $this->assertEquals(null, $person->getLongitude());
        $this->assertEquals(null, $person->getLatitudeLoose());
        $this->assertEquals(null, $person->getLongitudeLoose());
        $this->assertEquals(null, $person->getPhonePrivate());
        $this->assertEquals(null, $person->getPhoneWork());
        $this->assertEquals(null, $person->getMobile());
        $this->assertEquals(null, $person->getFax());
        $this->assertEquals("Doe", $person->getBirthName());
        $this->assertEquals("1992-06-02", $person->getBirthday());
        $this->assertEquals("1992-06-02 00:00:00", $person->getBirthdayAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("Bethlehem", $person->getBirthplace());
        $this->assertEquals("https://5pm.church.tools/images/875/2bc0d52971857aebbec193783f8b92d7d16a7342ea9beb220386b2c5872865bc", $person->getImageUrl());
        $this->assertEquals(null, $person->getFamilyImageUrl());
        $this->assertEquals(1, $person->getSexId());
        $this->assertEquals("DAVID.5PM@gmail.com", $person->getEmail());

        $this->assertEquals("DAVID.5PM@gmail.com", $person->getEmails()[0]["email"]);
        $this->assertEquals(true, $person->getEmails()[0]["isDefault"]);
        $this->assertEquals(2, $person->getEmails()[0]["contactLabelId"]);

        $this->assertEquals("dkönig", $person->getCmsUserId());
        $this->assertEquals(null, $person->getOptigemId());
        $this->assertEquals("2023-05-03", $person->getPrivacyPolicyAgreement()["date"]);
        $this->assertEquals(3, $person->getPrivacyPolicyAgreement()["typeId"]);
        $this->assertEquals(1, $person->getPrivacyPolicyAgreement()["whoId"]);
        $this->assertEquals("2023-05-03", $person->getPrivacyPolicyAgreementDate());
        $this->assertEquals(3, $person->getPrivacyPolicyAgreementTypeId());
        $this->assertEquals(1, $person->getPrivacyPolicyAgreementWhoId());
        $this->assertEquals(0, $person->getNationalityId());
        $this->assertEquals(0, $person->getFamilyStatusId());
        $this->assertEquals("2023-04-02", $person->getWeddingDate());
        $this->assertEquals("2023-04-02 00:00:00", $person->getWeddingDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getCampusId());
        $this->assertEquals(null, $person->getStatusId());
        $this->assertEquals([1], $person->getDepartmentIds());
        $this->assertEquals("2023-05-03", $person->getFirstContact());
        $this->assertEquals("2023-05-03 00:00:00", $person->getFirstContactAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getDateOfBelonging());
        $this->assertEquals(null, $person->getDateOfBelongingAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getDateOfEntry());
        $this->assertEquals(null, $person->getDateOfEntryAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getDateOfResign());
        $this->assertEquals(null, $person->getDateOfResignAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getDateOfBaptism());
        $this->assertEquals(null, $person->getDateOfBaptismAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $person->getPlaceOfBaptism());
        $this->assertEquals(null, $person->getBaptisedBy());
        $this->assertEquals(null, $person->getReferredBy());
        $this->assertEquals(null, $person->getReferredTo());
        $this->assertEquals(null, $person->getGrowPathId());
        $this->assertEquals(null, $person->getCanChat());
        $this->assertEquals("accepted", $person->getInvitationStatus());
        $this->assertEquals(true, $person->getChatActive());
        $this->assertEquals(null, $person->getIsArchived());
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

        $this->assertEquals("1997-03-01", $lastBirthdayPerson->getDate());
        $this->assertEquals("1997-03-01", $lastBirthdayPerson->getAnniversaryInitialDate());
        $this->assertEquals("2022-03-01", $lastBirthdayPerson->getAnniversary());

        $this->assertEquals("1997-03-01 00:00:00", $lastBirthdayPerson->getDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("1997-03-01 00:00:00", $lastBirthdayPerson->getAnniversaryInitialDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals("2022-03-01 00:00:00", $lastBirthdayPerson->getAnniversaryAsDateTime()?->format("Y-m-d H:i:s"));


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