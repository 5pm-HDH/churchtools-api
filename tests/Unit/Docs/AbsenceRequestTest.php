<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\Models\Absence;
use CTApi\Requests\AbsenceRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class AbsenceRequestTest extends TestCaseHttpMocked
{

    public function testRequestAllAbsences()
    {
        $absences = AbsenceRequest::forPerson(118)
            ->where("from_date", "2022-01-01")
            ->where("to_date", "2022-06-01")
            ->get();

        $vaccationAbsence = end($absences);

        $this->assertEquals("10", $vaccationAbsence->getId());
        $this->assertEquals("Vacation in the alps", $vaccationAbsence->getComment());
        $this->assertEquals("2", $vaccationAbsence->getAbsenceReason()?->getId());
        $this->assertEquals("Urlaub", $vaccationAbsence->getAbsenceReason()?->getName());
        $this->assertEquals("2022-02-23", $vaccationAbsence->getStartDate());
        $this->assertEquals("2022-02-23 00:00:00", $vaccationAbsence->getStartDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $vaccationAbsence->getStartTime());
        $this->assertEquals("2022-02-25", $vaccationAbsence->getEndDate());
        $this->assertEquals("2022-02-25 00:00:00", $vaccationAbsence->getEndDateAsDateTime()?->format("Y-m-d H:i:s"));
        $this->assertEquals(null, $vaccationAbsence->getEndTime());
        $this->assertEquals("Matthew", $vaccationAbsence->getPerson()?->getFirstName());
    }

    public function testCreateAbsence()
    {
        $absence = new Absence();
        $absence->setStartDate("2020-09-13")->setEndDate("2020-09-14");
        $absence->setComment("Meditation in the monastery.");
        $absence->setAbsenceReasonId("2");

        AbsenceRequest::createAbsence(118, $absence);

        $this->assertEquals("11", $absence->getId());
        $this->assertEquals("Meditation in the monastery.", $absence->getComment());
        $this->assertEquals("2", $absence->getAbsenceReason()?->getId());
        $this->assertEquals("Urlaub", $absence->getAbsenceReason()?->getName());
        $this->assertEquals("2020-09-13", $absence->getStartDate());
        $this->assertEquals(null, $absence->getStartTime());
        $this->assertEquals("2020-09-14", $absence->getEndDate());
        $this->assertEquals(null, $absence->getEndTime());
        $this->assertEquals("Matthew", $absence->getPerson()?->getFirstName());
    }

    public function testUpdateAbsence()
    {
        $absence = AbsenceRequest::findOrFail(118, 211); // for person with id 118 and absence with id 211

        $this->assertEquals("Meditation in the monastery.", $absence->getComment());

        $absence->setComment("Vacation in a Hotel.");
        AbsenceRequest::updateAbsence(118, $absence);

        $this->assertEquals("Vacation in a Hotel.", $absence->getComment());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDeleteAbsence()
    {
        $absence = AbsenceRequest::findOrFail(118, 211); // for person with id 118 and absence with id 211

        AbsenceRequest::deleteAbsence(118, $absence);
    }
}