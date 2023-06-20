<?php


namespace CTApi\Test\Integration\Requests;


use CTApi\Models\BirthdayPerson;
use CTApi\Requests\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;


use CTApi\Test\Integration\TestCaseAuthenticated;

class PersonBirthdayRequestTest extends TestCaseAuthenticated
{

    private $personId;
    private $from;
    private $to;

    private $birthdayDate;
    private $anniversaryDate;
    private $age;

    protected function setUp(): void
    {
        $this->personId = IntegrationTestData::getFilter("list_birthdays", "person_id");
        $this->from = IntegrationTestData::getFilter("list_birthdays", "from");
        $this->to = IntegrationTestData::getFilter("list_birthdays", "to");

        $this->birthdayDate = IntegrationTestData::getResult("list_birthdays", "birthday");
        $this->anniversaryDate = IntegrationTestData::getResult("list_birthdays", "anniversary");
        $this->age = IntegrationTestData::getResult("list_birthdays", "age");

    }

    public function testRetrieveBirthday()
    {
        $birthdayPersons = PersonRequest::birthdays()
            ->where("start_date", $this->from)
            ->where("end_date", $this->to)
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
        $this->assertEquals($this->anniversaryDate, $foundBirthdayChild->getAnniversary());
        $this->assertEquals($this->age, $foundBirthdayChild->getAge());
    }

}