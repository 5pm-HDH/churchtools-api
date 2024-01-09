<?php

namespace CTApi\Models\Groups\Person;

use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class BirthdayPerson
{
    use FillWithData;

    protected ?string $type = null;
    protected ?string $date = null;
    protected ?string $anniversaryInitialDate = null;
    protected ?string $anniversary = null;
    protected ?int $age = null;
    protected ?Person $person = null;

    protected function fillArrayType(string $key, array $data): void
    {
        if ($key == "person") {
            $this->person = Person::createModelFromData($data);
            return;
        }
        $this->fillDefault($key, $data);
    }

    public function getDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->date);
    }

    public function getAnniversaryInitialDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->anniversaryInitialDate);
    }

    public function getAnniversaryAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->anniversary);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return BirthdayPerson
     */
    public function setType(?string $type): BirthdayPerson
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     * @return BirthdayPerson
     */
    public function setDate(?string $date): BirthdayPerson
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnniversaryInitialDate(): ?string
    {
        return $this->anniversaryInitialDate;
    }

    /**
     * @param string|null $anniversaryInitialDate
     * @return BirthdayPerson
     */
    public function setAnniversaryInitialDate(?string $anniversaryInitialDate): BirthdayPerson
    {
        $this->anniversaryInitialDate = $anniversaryInitialDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnniversary(): ?string
    {
        return $this->anniversary;
    }

    /**
     * @param string|null $anniversary
     * @return BirthdayPerson
     */
    public function setAnniversary(?string $anniversary): BirthdayPerson
    {
        $this->anniversary = $anniversary;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     * @return BirthdayPerson
     */
    public function setAge(?int $age): BirthdayPerson
    {
        $this->age = $age;
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
     * @return BirthdayPerson
     */
    public function setPerson(?Person $person): BirthdayPerson
    {
        $this->person = $person;
        return $this;
    }
}
