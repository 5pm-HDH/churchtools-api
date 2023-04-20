<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Address
{
    use FillWithData;

    protected ?string $meetingAt = null;
    protected ?string $street = null;
    protected ?string $addition = null;
    protected ?string $district = null;
    protected ?string $zip = null;
    protected ?string $city = null;
    protected ?string $country = null;
    protected ?string $latitude = null;
    protected ?string $longitude = null;

    /**
     * @return string|null
     */
    public function getMeetingAt(): ?string
    {
        return $this->meetingAt;
    }

    /**
     * @param string|null $meetingAt
     * @return Address
     */
    public function setMeetingAt(?string $meetingAt): Address
    {
        $this->meetingAt = $meetingAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddition(): ?string
    {
        return $this->addition;
    }

    /**
     * @param string|null $addition
     * @return Address
     */
    public function setAddition(?string $addition): Address
    {
        $this->addition = $addition;
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
     * @return Address
     */
    public function setDistrict(?string $district): Address
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * @return Address
     */
    public function setZip(?string $zip): Address
    {
        $this->zip = $zip;
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
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return Address
     */
    public function setCountry(?string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return Address
     */
    public function setLatitude(?string $latitude): Address
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return Address
     */
    public function setLongitude(?string $longitude): Address
    {
        $this->longitude = $longitude;
        return $this;
    }
}