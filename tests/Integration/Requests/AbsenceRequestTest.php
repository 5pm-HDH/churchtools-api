<?php

namespace CTApi\Test\Integration\Requests;

use CTApi\Models\Events\Absence\Absence;
use CTApi\Models\Events\Absence\AbsencePersonRequestBuilder;
use CTApi\Models\Events\Absence\AbsenceRequest;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Test\Integration\IntegrationTestData;
use CTApi\Test\Integration\TestCaseAuthenticated;

class AbsenceRequestTest extends TestCaseAuthenticated
{
    private ?string $startDate = null;
    private ?string $endDate = null;
    private ?string $absencePersonComment = null;
    private ?string $absencePersonReason = null;
    private ?string $absenceStartDate = null;
    private ?string $absenceEndDate = null;

    private int $myselfId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->myselfId = IntegrationTestData::getFilterAsInt("filter_absence", "person_id");
        $this->startDate = IntegrationTestData::getFilter("filter_absence", "start_date");
        $this->endDate = IntegrationTestData::getFilter("filter_absence", "end_date");

        $this->absencePersonComment = IntegrationTestData::getResult("filter_absence", "comment");
        $this->absencePersonReason = IntegrationTestData::getResult("filter_absence", "reason");
        $this->absenceStartDate = IntegrationTestData::getResult("filter_absence", "start_date");
        $this->absenceEndDate = IntegrationTestData::getResult("filter_absence", "end_date");
    }

    public function testRequestFacade()
    {
        $requestBuilder = AbsenceRequest::forPerson($this->myselfId);

        $this->assertAbsenceExists($requestBuilder);
    }

    public function testPersonMethod()
    {
        $requestBuilder = PersonRequest::findOrFail($this->myselfId)->requestAbsence();
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
        $this->assertEquals($testAbsence->getStartDate(), $this->absenceStartDate);
        $this->assertEquals($testAbsence->getEndDate(), $this->absenceEndDate);
    }

    public function testCreateUpdateAndDeleteAbsence()
    {
        $absence = $this->createAbsence();
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

        $freshLoadedAbsence = AbsenceRequest::findOrFail($this->myselfId, $absence->getIdAsInteger());
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
        $absenceId = $absence->getIdAsInteger();
        AbsenceRequest::deleteAbsence($this->myselfId, $absence);

        $freshLoadedAbsence = AbsenceRequest::find($this->myselfId, $absenceId);
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
