<?php


namespace Tests\Integration\Requests;


use CTApi\CTConfig;
use CTApi\Models\Absence;
use CTApi\Requests\AbsencePersonRequestBuilder;
use CTApi\Requests\AbsenceRequest;
use CTApi\Requests\PersonRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class AbsenceRequestTest extends TestCaseAuthenticated
{

    private ?string $startDate = null;
    private ?string $endDate = null;
    private ?string $absencePersonComment = null;
    private ?string $absencePersonReason = null;

    private int $myselfId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkIfTestSuiteIsEnabled("ABSENCE");
        $this->startDate = TestData::getValue("ABSENCE_START_DATE");
        $this->endDate = TestData::getValue("ABSENCE_END_DATE");
        $this->absencePersonComment = TestData::getValue("ABSENCE_PERSON_COMMENT");
        $this->absencePersonReason = TestData::getValue("ABSENCE_PERSON_REASON");

        $myself = PersonRequest::whoami();
        $this->myselfId = (int)$myself->getId();
    }

    public function testRequestFacade()
    {
        $myself = PersonRequest::whoami();
        $requestBuilder = AbsenceRequest::forPerson((int)$myself->getId());

        $this->assertAbsenceExists($requestBuilder);
    }

    public function testPersonMethod()
    {
        $requestBuilder = PersonRequest::whoami()->requestAbsence();
        $this->assertNotNull($requestBuilder);
        $this->assertAbsenceExists($requestBuilder);
    }

    public function assertAbsenceExists(AbsencePersonRequestBuilder $absencePersonRequestBuilder)
    {
        $absences = $absencePersonRequestBuilder->where("from_date", $this->startDate)
            ->where("to_date", $this->endDate)
            ->get();

        $testAbsence = null;
        foreach ($absences as $absence) {
            if ($absence->getComment() == $this->absencePersonComment) {
                $testAbsence = $absence;
            }
        }

        $this->assertNotNull($testAbsence);
        $this->assertEquals($testAbsence->getAbsenceReason()?->getName(), $this->absencePersonReason);
    }

    public function testCreateUpdateAndDeleteAbsence()
    {

        $absence = $this->createAbsence();
        CTConfig::enableDebugging();
        $this->updateAbsence($absence);
        $this->deleteAbsence($absence);
    }

    private function createAbsence(): Absence
    {

        $absence = new Absence();
        $absence->setStartDate("2020-09-13");
        $absence->setEndDate("2020-09-14");
        $absence->setAbsenceReasonId("2");
        $absence->setComment("Meditation in the monastery.");

        $this->assertNull($absence->getId()); // id is null because the absence is not created yet

        AbsenceRequest::createAbsence($this->myselfId, $absence);

        $this->assertNotNull($absence->getId()); // id is filled with response data

        $freshLoadedAbsence = AbsenceRequest::findOrFail($this->myselfId, (int)$absence->getId());
        $this->assertAbsenceIsEqual($absence, $freshLoadedAbsence);


        return $absence;
    }

    private function updateAbsence(Absence &$absence)
    {
        $absence->setComment("Updated comment for meditation in the monastery.");
        $absence->setEndDate("2020-09-16");

        AbsenceRequest::updateAbsence($this->myselfId, $absence);

        $this->assertEquals("Updated comment for meditation in the monastery.", $absence->getComment());
        $this->assertEquals("2020-09-13", $absence->getStartDate());
        $this->assertEquals("2020-09-16", $absence->getEndDate());
    }

    private function deleteAbsence(Absence $absence)
    {
        $absenceId = $absence->getId();
        $this->assertNotNull($absenceId);

        AbsenceRequest::deleteAbsence($this->myselfId, $absence);

        $freshLoadedAbsence = AbsenceRequest::find($this->myselfId, (int)$absenceId);
        $this->assertNull($freshLoadedAbsence);
    }

    private function assertAbsenceIsEqual(Absence $absenceA, Absence $absenceB)
    {
        $this->assertEquals($absenceA->getStartDate(), $absenceB->getStartDate());
        $this->assertEquals($absenceA->getStartTime(), $absenceB->getStartTime());
        $this->assertEquals($absenceA->getEndDate(), $absenceB->getEndDate());
        $this->assertEquals($absenceA->getEndTime(), $absenceB->getEndTime());
        $this->assertEquals($absenceA->getComment(), $absenceB->getComment());
    }

}