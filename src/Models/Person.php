<?php


namespace CTApi\Models;


use CTApi\Models\Interfaces\UpdatableModel;
use CTApi\Models\Traits\ExtractData;
use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;
use CTApi\Requests\AbsencePersonRequestBuilder;
use CTApi\Requests\FileRequest;
use CTApi\Requests\FileRequestBuilder;
use CTApi\Requests\PersonEventRequestBuilder;
use CTApi\Requests\PersonGroupRequestBuilder;
use CTApi\Requests\PersonTagRequestBuilder;

class Person extends AbstractModel implements UpdatableModel
{
    use FillWithData, ExtractData, MetaAttribute;

    protected ?string $guid = null;
    protected ?string $firstName = null;
    protected ?string $lastName = null;
    protected ?string $nickname = null;
    protected ?string $job = null;
    protected ?string $street = null;
    protected ?string $addressAddition = null;
    protected ?string $zip = null;
    protected ?string $city = null;
    protected ?string $country = null;

    protected ?string $phonePrivate = null;
    protected ?string $phoneWork = null;
    protected ?string $mobile = null;
    protected ?string $fax = null;

    protected ?string $birthName = null;
    protected ?string $birthplace = null;
    protected ?string $birthday = null;
    protected ?string $imageUrl = null;
    protected ?string $sexId = null;
    protected ?string $email = null;

    protected array $departmentIds = [];
    protected ?int $statusId = null;
    protected ?int $campusId = null;

    protected ?Meta $meta = null;

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "domainIdentifier":
                $this->setId($value);
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            case "domainAttributes":
                $this->processDomainAttributes($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getModifiableAttributes(): array
    {
        return [
            'addressAddition',
            'birthday',
            'birthName',
            'birthplace',
            'campusId',
            'city',
            'country',
            'departmentIds',
            'email',
            'fax',
            'firstName',
            'job',
            'lastName',
            'mobile',
            'nickname',
            'phonePrivate',
            'phoneWork',
            'sexId',
            'statusId',
            'street',
            'zip',
        ];
    }

    private function processDomainAttributes(array $domainAttributes): void
    {
        if (array_key_exists('firstName', $domainAttributes)) {
            $this->setFirstName($domainAttributes['firstName']);
        }
        if (array_key_exists('lastName', $domainAttributes)) {
            $this->setLastName($domainAttributes['lastName']);
        }
        if (array_key_exists('guid', $domainAttributes)) {
            $this->setGuid($domainAttributes['guid']);
        }
    }

    public function requestEvents(): ?PersonEventRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new PersonEventRequestBuilder((int)$this->getId());
        }
        return null;
    }

    public function requestGroups(): ?PersonGroupRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new PersonGroupRequestBuilder((int)$this->getId());
        }
        return null;
    }

    public function requestAvatar(): ?FileRequestBuilder
    {
        if (!is_null($this->getId())) {
            return FileRequest::forAvatar((int)$this->getId());
        }
        return null;
    }

    public function requestTags(): ?PersonTagRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new PersonTagRequestBuilder((int)$this->getId());
        }
        return null;
    }

    public function requestAbsence(): ?AbsencePersonRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new AbsencePersonRequestBuilder((int)$this->getId());
        }
        return null;
    }

    /**
     * @param string|null $id
     * @return Person
     */
    public function setId(?string $id): Person
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }

    /**
     * @param string|null $guid
     * @return Person
     */
    public function setGuid(?string $guid): Person
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return Person
     */
    public function setFirstName(?string $firstName): Person
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return Person
     */
    public function setLastName(?string $lastName): Person
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string|null $nickname
     * @return Person
     */
    public function setNickname(?string $nickname): Person
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * @param string|null $job
     * @return Person
     */
    public function setJob(?string $job): Person
    {
        $this->job = $job;
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
     * @return Person
     */
    public function setStreet(?string $street): Person
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressAddition(): ?string
    {
        return $this->addressAddition;
    }

    /**
     * @param string|null $addressAddition
     * @return Person
     */
    public function setAddressAddition(?string $addressAddition): Person
    {
        $this->addressAddition = $addressAddition;
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
     * @return Person
     */
    public function setZip(?string $zip): Person
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
     * @return Person
     */
    public function setCity(?string $city): Person
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
     * @return Person
     */
    public function setCountry(?string $country): Person
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhonePrivate(): ?string
    {
        return $this->phonePrivate;
    }

    /**
     * @param string|null $phonePrivate
     * @return Person
     */
    public function setPhonePrivate(?string $phonePrivate): Person
    {
        $this->phonePrivate = $phonePrivate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneWork(): ?string
    {
        return $this->phoneWork;
    }

    /**
     * @param string|null $phoneWork
     * @return Person
     */
    public function setPhoneWork(?string $phoneWork): Person
    {
        $this->phoneWork = $phoneWork;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * @param string|null $mobile
     * @return Person
     */
    public function setMobile(?string $mobile): Person
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     * @return Person
     */
    public function setFax(?string $fax): Person
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthName(): ?string
    {
        return $this->birthName;
    }

    /**
     * @param string|null $birthName
     * @return Person
     */
    public function setBirthName(?string $birthName): Person
    {
        $this->birthName = $birthName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    /**
     * @param string|null $birthplace
     * @return Person
     */
    public function setBirthplace(?string $birthplace): Person
    {
        $this->birthplace = $birthplace;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     * @return Person
     */
    public function setBirthday(?string $birthday): Person
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return Person
     */
    public function setImageUrl(?string $imageUrl): Person
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexId(): ?string
    {
        return $this->sexId;
    }

    /**
     * @param string|null $sexId
     * @return Person
     */
    public function setSexId(?string $sexId): Person
    {
        $this->sexId = $sexId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Person
     */
    public function setEmail(?string $email): Person
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the list of department IDs.
     *
     * @return int[]
     */
    public function getDepartmentIds(): array
    {
        return $this->departmentIds;
    }

    /**
     * Add a department ID.
     */
    public function addDepartmentId(int $departmentId): Person
    {
        if (!in_array($departmentId, $this->departmentIds, true)) {
            $this->departmentIds[] = $departmentId;
        }

        return $this;
    }

    public function removeDepartmentId(int $departmentId): Person
    {
        $position = array_search($departmentId, $this->departmentIds, true);

        if ($position !== false) {
            array_splice($this->departmentIds, $position, 1);
        }

        return $this;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): self
    {
        $this->statusId = $statusId;
        return $this;
    }

    public function getCampusId(): ?int
    {
        return $this->campusId;
    }

    public function setCampusId(int $campusId): self
    {
        $this->campusId = $campusId;
        return $this;
    }


}