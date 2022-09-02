<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Models\BirthdayPerson;
use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class PersonBirthdayRequestTest extends TestCaseAuthenticated
{

    private $personId;
    private $birthdayDate;

    protected function setUp(): void
    {
        parent::setUp();
        if (!TestData::getValue("BIRTHDAY_SHOULD_TEST") == "YES") {
            $this->markTestSkipped("Test suite is disabled in testdata.ini");
        } else {
            $this->personId = TestData::getValue("BIRTHDAY_PERSON_ID");
            $this->birthdayDate = TestData::getValue("BIRTHDAY_DATE");
        }
    }

    public function testRetrieveBirthday()
    {
        $birthdayPersons = PersonRequest::birthdays()
            ->where("start_date", "2022-01-01")
            ->where("end_date", "2022-12-31")
            ->get();

        $foundBirthdayChild = null;
        foreach ($birthdayPersons as $birthdayPerson) {
            $this->assertInstanceOf(BirthdayPerson::class, $birthdayPerson);
            if ($birthdayPerson->getPerson()?->getId() == $this->personId) {
                $foundBirthdayChild = $birthdayPerson;
            }
        }

        $this->assertNotNull($foundBirthdayChild, "Could not find the birthday person.");
        $this->assertEquals($this->personId, $foundBirthdayChild->getPerson()?->getId());
        $this->assertEquals($this->birthdayDate, $foundBirthdayChild->getAnniversaryInitialDate());
    }

}