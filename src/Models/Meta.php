<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\PersonRequest;

class Meta
{
    use FillWithData;

    protected ?string $createdDate = null;
    protected ?Person $createdPerson = null;
    protected ?string $modifiedDate = null;
    protected ?Person $modifiedPerson = null;

    protected function fillArrayType(string $key, array $data)
    {
        switch ($key) {
            case "createdPerson":
                $this->setCreatedPerson(Person::createModelFromData($data));
                break;
            case "modifiedPerson":
                $this->setModifiedPerson(Person::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
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
        if (!is_null($this->getCreatedPerson())) {
            $id = $this->getModifiedPerson()->getId();
            return $this->requestPerson($id);
        }
        return null;
    }

    private function requestPerson(?string $id): ?Person
    {
        if (!is_null($id)) {
            return PersonRequest::find($id);
        }
        return null;
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