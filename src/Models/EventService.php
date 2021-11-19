<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\PersonRequest;
use CTApi\Requests\ServiceRequest;

class EventService
{

    use FillWithData;

    protected ?string $id = null;
    protected ?string $personId = null;
    protected ?Person $person = null;
    protected ?string $name = null;
    protected ?string $serviceId = null;
    protected ?string $agreed = null;
    protected ?string $isValid = null;
    protected ?string $requestedDate = null;
    protected ?string $requesterPersonId = null;
    protected ?Person $requesterPerson = null;
    protected ?string $comment = null;
    protected ?string $counter = null;
    protected ?string $allowChat = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "person":
                $personData = $this->processPersonInformationToPersonData($data);
                $this->setPerson(Person::createModelFromData($personData));
                break;
            case "requesterPerson":
                $personData = $this->processPersonInformationToPersonData($data);
                $this->setRequesterPerson(Person::createModelFromData($personData));
                break;
            default:
                $this->{$key} = $data;
        }
    }

    /**
     * @param array $personInformation
     * @return array
     *
     * Churchtools generates a strange format for person information in this API-Call. Some attributes must be
     * transformed with this transformer method.
     */
    private function processPersonInformationToPersonData(array $personInformation): array
    {
        $personData = [];

        if (array_key_exists('domainIdentifier', $personInformation)) {
            $personData["id"] = $personInformation['domainIdentifier'];
        }
        if (array_key_exists('title', $personInformation)) {
            $personData['name'] = $personInformation['title'];
        }

        if (array_key_exists('domainAttributes', $personInformation)) {
            $personData = array_merge($personData, $personInformation['domainAttributes']);
        }

        $personData = array_merge($personData, $personInformation);
        return $personData;
    }

    public function requestPerson(): ?Person
    {
        if (!is_null($this->getPersonId())) {
            return PersonRequest::find((int)$this->getPersonId());
        }
        return null;
    }

    public function requestRequesterPerson(): ?Person
    {
        if (!is_null($this->getRequesterPersonId())) {
            return PersonRequest::find((int)$this->getRequesterPersonId());
        }
        return null;
    }

    public function requestService(): ?Service
    {
        if (!is_null($this->getServiceId())) {
            return ServiceRequest::find((int)$this->getServiceId());
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return EventService
     */
    public function setId(?string $id): EventService
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    /**
     * @param string|null $personId
     * @return EventService
     */
    public function setPersonId(?string $personId): EventService
    {
        $this->personId = $personId;
        return $this;
    }

    /**
     * @return ?Person
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return EventService
     */
    public function setPerson(Person $person): EventService
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return EventService
     */
    public function setName(?string $name): EventService
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getServiceId(): ?string
    {
        return $this->serviceId;
    }

    /**
     * @param string|null $serviceId
     * @return EventService
     */
    public function setServiceId(?string $serviceId): EventService
    {
        $this->serviceId = $serviceId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAgreed(): ?string
    {
        return $this->agreed;
    }

    /**
     * @param string|null $agreed
     * @return EventService
     */
    public function setAgreed(?string $agreed): EventService
    {
        $this->agreed = $agreed;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsValid(): ?string
    {
        return $this->isValid;
    }

    /**
     * @param string|null $isValid
     * @return EventService
     */
    public function setIsValid(?string $isValid): EventService
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRequestedDate(): ?string
    {
        return $this->requestedDate;
    }

    /**
     * @param string|null $requestedDate
     * @return EventService
     */
    public function setRequestedDate(?string $requestedDate): EventService
    {
        $this->requestedDate = $requestedDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRequesterPersonId(): ?string
    {
        return $this->requesterPersonId;
    }

    /**
     * @param string|null $requesterPersonId
     * @return EventService
     */
    public function setRequesterPersonId(?string $requesterPersonId): EventService
    {
        $this->requesterPersonId = $requesterPersonId;
        return $this;
    }

    /**
     * @return ?Person
     */
    public function getRequesterPerson(): ?Person
    {
        return $this->requesterPerson;
    }

    /**
     * @param Person $requesterPerson
     * @return EventService
     */
    public function setRequesterPerson(Person $requesterPerson): EventService
    {
        $this->requesterPerson = $requesterPerson;
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
     * @return EventService
     */
    public function setComment(?string $comment): EventService
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCounter(): ?string
    {
        return $this->counter;
    }

    /**
     * @param string|null $counter
     * @return EventService
     */
    public function setCounter(?string $counter): EventService
    {
        $this->counter = $counter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllowChat(): ?string
    {
        return $this->allowChat;
    }

    /**
     * @param string|null $allowChat
     * @return EventService
     */
    public function setAllowChat(?string $allowChat): EventService
    {
        $this->allowChat = $allowChat;
        return $this;
    }

}