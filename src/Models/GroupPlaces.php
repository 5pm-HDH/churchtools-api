<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class GroupPlaces
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
        switch ($key){
            case "createdPerson":
                $this->createdPerson = Person::createModelFromData($data);
                break;
            default:
                $this->{$key} = $data;
        }
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
     * @return GroupPlaces
     */
    public function setName(?string $name): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setDistrict(?string $district): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setPostalcode(?string $postalcode): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setCity(?string $city): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setMarkerUrl(?string $markerUrl): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setGeoLat(?string $geoLat): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setGeoLng(?string $geoLng): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setCreatedDate(?string $createdDate): GroupPlaces
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
     * @return GroupPlaces
     */
    public function setCreatedPerson(?Person $createdPerson): GroupPlaces
    {
        $this->createdPerson = $createdPerson;
        return $this;
    }
}