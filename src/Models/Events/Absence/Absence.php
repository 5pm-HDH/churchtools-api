<?php

namespace CTApi\Models\Events\Absence;

use CTApi\Interfaces\UpdatableModel;
use CTApi\Models\AbstractModel;
use CTApi\Models\Groups\Person\Person;
use CTApi\Traits\Model\ExtractData;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class Absence extends AbstractModel implements UpdatableModel
{
    use FillWithData;
    use ExtractData;

    protected ?string $comment = null;
    protected ?string $absenceReasonId = null;
    protected ?AbsenceReason $absenceReason = null;
    protected ?string $startDate = null;
    protected ?string $startTime = null;
    protected ?string $endDate = null;
    protected ?string $endTime = null;
    protected ?Person $person = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "absenceReason":
                $this->absenceReason = AbsenceReason::createModelFromData($data);
                break;
            case "person":
                $this->person = Person::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public static function getModifiableAttributes(): array
    {
        return [
            "comment",
            "absenceReasonId",
            "endDate",
            "endTime",
            "startDate",
            "startTime"
        ];
    }

    public function getStartDateAsDateTime()
    {
        return CTDateTimeService::stringToDateTime($this->startDate);
    }

    public function getEndDateAsDateTime()
    {
        return CTDateTimeService::stringToDateTime($this->endDate);
    }

    /**
     * @param string|null $id
     * @return Absence
     */
    public function setId(?string $id): Absence
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return Absence
     */
    public function setComment(?string $comment): Absence
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAbsenceReasonId(): ?string
    {
        return $this->absenceReasonId;
    }

    /**
     * @param string|null $absenceReasonId
     * @return Absence
     */
    public function setAbsenceReasonId(?string $absenceReasonId): Absence
    {
        $this->absenceReasonId = $absenceReasonId;
        return $this;
    }

    /**
     * @return AbsenceReason|null
     */
    public function getAbsenceReason(): ?AbsenceReason
    {
        return $this->absenceReason;
    }

    /**
     * @param AbsenceReason|null $absenceReason
     * @return Absence
     */
    public function setAbsenceReason(?AbsenceReason $absenceReason): Absence
    {
        $this->absenceReason = $absenceReason;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @param string|null $startDate
     * @return Absence
     */
    public function setStartDate(?string $startDate): Absence
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    /**
     * @param string|null $startTime
     * @return Absence
     */
    public function setStartTime(?string $startTime): Absence
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @param string|null $endDate
     * @return Absence
     */
    public function setEndDate(?string $endDate): Absence
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->endTime;
    }

    /**
     * @param string|null $endTime
     * @return Absence
     */
    public function setEndTime(?string $endTime): Absence
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return Person|null
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person|null $person
     * @return Absence
     */
    public function setPerson(?Person $person): Absence
    {
        $this->person = $person;
        return $this;
    }
}
