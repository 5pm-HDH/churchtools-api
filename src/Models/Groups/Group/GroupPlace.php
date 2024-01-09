<?php

namespace CTApi\Models\Groups\Group;

use CTApi\Models\Groups\Person\Person;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class GroupPlace
{
    use FillWithData;

    protected ?string $name = null;
    protected ?string $district = null;
    protected ?string $postalcode = null;
    protected ?string $city = null;
    protected ?string $markerUrl = null;
    protected ?string $geoLat = null;
    protected ?string $geoLng = null;
    protected ?string $createdDate = null;
    protected ?Person $createdPerson = null;


    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "createdPerson":
                $this->createdPerson = Person::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public function getCreatedDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->createdDate);
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
     * @return GroupPlace
     */
    public function setName(?string $name): GroupPlace
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     * @return GroupPlace
     */
    public function setDistrict(?string $district): GroupPlace
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    /**
     * @param string|null $postalcode
     * @return GroupPlace
     */
    public function setPostalcode(?string $postalcode): GroupPlace
    {
        $this->postalcode = $postalcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return GroupPlace
     */
    public function setCity(?string $city): GroupPlace
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMarkerUrl(): ?string
    {
        return $this->markerUrl;
    }

    /**
     * @param string|null $markerUrl
     * @return GroupPlace
     */
    public function setMarkerUrl(?string $markerUrl): GroupPlace
    {
        $this->markerUrl = $markerUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGeoLat(): ?string
    {
        return $this->geoLat;
    }

    /**
     * @param string|null $geoLat
     * @return GroupPlace
     */
    public function setGeoLat(?string $geoLat): GroupPlace
    {
        $this->geoLat = $geoLat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGeoLng(): ?string
    {
        return $this->geoLng;
    }

    /**
     * @param string|null $geoLng
     * @return GroupPlace
     */
    public function setGeoLng(?string $geoLng): GroupPlace
    {
        $this->geoLng = $geoLng;
        return $this;
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
     * @return GroupPlace
     */
    public function setCreatedDate(?string $createdDate): GroupPlace
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
     * @return GroupPlace
     */
    public function setCreatedPerson(?Person $createdPerson): GroupPlace
    {
        $this->createdPerson = $createdPerson;
        return $this;
    }
}
