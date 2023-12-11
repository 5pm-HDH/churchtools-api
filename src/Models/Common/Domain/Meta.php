<?php


namespace CTApi\Models\Common\Domain;


use CTApi\Models\Groups\Person\Person;
use CTApi\Models\Groups\Person\PersonRequest;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;
use CTApi\Utils\CTUtil;

class Meta
{
    use FillWithData;

    protected ?string $createdDate = null;
    protected ?Person $createdPerson = null;
    protected ?string $modifiedDate = null;
    protected ?Person $modifiedPerson = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "createdPerson":
                $this->setCreatedPerson($this->convertDataToPerson($data));
                break;
            case "modifiedPerson":
                $this->setModifiedPerson($this->convertDataToPerson($data));
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "modifiedPid":
                $this->setModifiedPerson(Person::createModelFromData(["id" => $value]));
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    private function convertDataToPerson(array $data): Person
    {
        $person = Person::createModelFromData($data);

        if (
            !is_null(CTUtil::arrayPathGet($data, 'domainType')) &&
            (CTUtil::arrayPathGet($data, 'domainType') == "person") &&
            !is_null(CTUtil::arrayPathGet($data, 'domainIdentifier'))
        ) {
            $person->setId(CTUtil::arrayPathGet($data, 'domainIdentifier'));
        }

        if (!is_null(CTUtil::arrayPathGet($data, 'domainAttributes.firstName'))) {
            $person->setFirstName(CTUtil::arrayPathGet($data, 'domainAttributes.firstName'));
        }
        if (!is_null(CTUtil::arrayPathGet($data, 'domainAttributes.lastName'))) {
            $person->setLastName(CTUtil::arrayPathGet($data, 'domainAttributes.lastName'));
        }
        if (!is_null(CTUtil::arrayPathGet($data, 'domainAttributes.guid'))) {
            $person->setGuid(CTUtil::arrayPathGet($data, 'domainAttributes.guid'));
        }

        return $person;
    }

    public function requestCreatedPerson(): ?Person
    {
        if (!is_null($this->getCreatedPerson())) {
            $id = $this->getCreatedPerson()->getId();
            return $this->requestPerson($id);
        }
        return null;
    }

    public function requestModifiedPerson(): ?Person
    {
        if (!is_null($this->getModifiedPerson())) {
            $id = $this->getModifiedPerson()->getId();
            return $this->requestPerson($id);
        }
        return null;
    }

    private function requestPerson(?string $id): ?Person
    {
        if (!is_null($id) && $id > 0) {
            return PersonRequest::find((int)$id);
        }
        return null;
    }

    public function getModifiedDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->modifiedDate);
    }

    public function getCreatedDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->createdDate);
    }

    /**
     * @return string|null
     */
    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    /**
     * @param string|null $createdDate
     * @return Meta
     */
    public function setCreatedDate(?string $createdDate): Meta
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return Person|null
     */
    public function getCreatedPerson(): ?Person
    {
        return $this->createdPerson;
    }

    /**
     * @param Person|null $createdPerson
     * @return Meta
     */
    public function setCreatedPerson(?Person $createdPerson): Meta
    {
        $this->createdPerson = $createdPerson;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModifiedDate(): ?string
    {
        return $this->modifiedDate;
    }

    /**
     * @param string|null $modifiedDate
     * @return Meta
     */
    public function setModifiedDate(?string $modifiedDate): Meta
    {
        $this->modifiedDate = $modifiedDate;
        return $this;
    }

    /**
     * @return Person|null
     */
    public function getModifiedPerson(): ?Person
    {
        return $this->modifiedPerson;
    }

    /**
     * @param Person|null $modifiedPerson
     * @return Meta
     */
    public function setModifiedPerson(?Person $modifiedPerson): Meta
    {
        $this->modifiedPerson = $modifiedPerson;
        return $this;
    }
}