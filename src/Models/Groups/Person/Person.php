<?php


namespace CTApi\Models\Groups\Person;


use CTApi\Interfaces\UpdatableModel;
use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Common\File\FileRequest;
use CTApi\Models\Common\File\FileRequestBuilder;
use CTApi\Models\Events\Absence\AbsencePersonRequestBuilder;
use CTApi\Traits\Model\ExtractData;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\HasDBFields;
use CTApi\Traits\Model\MetaAttribute;
use CTApi\Utils\CTDateTimeService;

class Person extends AbstractModel implements UpdatableModel
{
    use FillWithData, ExtractData, MetaAttribute, HasDBFields;

    protected ?string $guid = null;
    protected ?int $securityLevelForPerson = null;
    protected ?int $editSecurityLevelForPerson = null;

    protected ?string $title = null;
    protected ?string $firstName = null;
    protected ?string $lastName = null;
    protected ?string $nickname = null;
    protected ?string $job = null;
    protected ?string $street = null;
    protected ?string $addressAddition = null;
    protected ?string $zip = null;
    protected ?string $city = null;
    protected ?string $country = null;
    protected ?string $latitude = null;
    protected ?string $longitude = null;
    protected ?string $latitudeLoose = null;
    protected ?string $longitudeLoose = null;

    protected ?string $phonePrivate = null;
    protected ?string $phoneWork = null;
    protected ?string $mobile = null;
    protected ?string $fax = null;

    protected ?string $birthName = null;
    protected ?string $birthday = null;
    protected ?string $birthplace = null;
    protected ?string $imageUrl = null;
    protected ?string $familyImageUrl = null;
    protected ?string $sexId = null;
    protected ?string $email = null;
    protected array $emails = [];

    protected ?string $cmsUserId = null;
    protected ?string $optigemId = null;

    protected array $privacyPolicyAgreement = [];
    protected ?string $privacyPolicyAgreementDate = null;
    protected ?int $privacyPolicyAgreementTypeId = null;
    protected ?int $privacyPolicyAgreementWhoId = null;

    protected ?int $nationalityId = null;
    protected ?int $familyStatusId = null;
    protected ?string $weddingDate = null;

    protected array $departmentIds = [];
    protected ?int $statusId = null;
    protected ?int $campusId = null;

    protected ?string $firstContact = null;
    protected ?string $dateOfBelonging = null;
    protected ?string $dateOfEntry = null;
    protected ?string $dateOfResign = null;
    protected ?string $dateOfBaptism = null;
    protected ?string $placeOfBaptism = null;
    protected ?string $baptisedBy = null;
    protected ?string $referredBy = null;
    protected ?string $referredTo = null;
    protected ?int $growPathId = null;
    protected ?bool $canChat = null;
    protected ?bool $chatActive = null;

    protected ?string $invitationStatus = null;
    protected ?bool $isArchived = null;

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
            return new PersonEventRequestBuilder($this->getIdAsInteger());
        }
        return null;
    }

    public function requestGroups(): ?PersonGroupRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new PersonGroupRequestBuilder($this->getIdAsInteger());
        }
        return null;
    }

    public function requestAvatar(): ?FileRequestBuilder
    {
        if (!is_null($this->getId())) {
            return FileRequest::forAvatar($this->getIdAsInteger());
        }
        return null;
    }

    public function requestTags(): ?PersonTagRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new PersonTagRequestBuilder($this->getIdAsInteger());
        }
        return null;
    }

    public function requestAbsence(): ?AbsencePersonRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new AbsencePersonRequestBuilder($this->getIdAsInteger());
        }
        return null;
    }

    public function getBirthdayAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->birthday);
    }

    public function getFirstContactAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->firstContact);
    }

    public function getDateOfBelongingAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateOfBelonging);
    }

    public function getDateOfEntryAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateOfEntry);
    }

    public function getDateOfResignAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateOfResign);
    }

    public function getDateOfBaptismAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->dateOfBaptism);
    }

    public function getWeddingDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->weddingDate);
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

    /**
     * @return int|null
     */
    public function getSecurityLevelForPerson(): ?int
    {
        return $this->securityLevelForPerson;
    }

    /**
     * @param int|null $securityLevelForPerson
     * @return Person
     */
    public function setSecurityLevelForPerson(?int $securityLevelForPerson): Person
    {
        $this->securityLevelForPerson = $securityLevelForPerson;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEditSecurityLevelForPerson(): ?int
    {
        return $this->editSecurityLevelForPerson;
    }

    /**
     * @param int|null $editSecurityLevelForPerson
     * @return Person
     */
    public function setEditSecurityLevelForPerson(?int $editSecurityLevelForPerson): Person
    {
        $this->editSecurityLevelForPerson = $editSecurityLevelForPerson;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Person
     */
    public function setTitle(?string $title): Person
    {
        $this->title = $title;
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
     * @return Person
     */
    public function setLatitude(?string $latitude): Person
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
     * @return Person
     */
    public function setLongitude(?string $longitude): Person
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitudeLoose(): ?string
    {
        return $this->latitudeLoose;
    }

    /**
     * @param string|null $latitudeLoose
     * @return Person
     */
    public function setLatitudeLoose(?string $latitudeLoose): Person
    {
        $this->latitudeLoose = $latitudeLoose;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitudeLoose(): ?string
    {
        return $this->longitudeLoose;
    }

    /**
     * @param string|null $longitudeLoose
     * @return Person
     */
    public function setLongitudeLoose(?string $longitudeLoose): Person
    {
        $this->longitudeLoose = $longitudeLoose;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFamilyImageUrl(): ?string
    {
        return $this->familyImageUrl;
    }

    /**
     * @param string|null $familyImageUrl
     * @return Person
     */
    public function setFamilyImageUrl(?string $familyImageUrl): Person
    {
        $this->familyImageUrl = $familyImageUrl;
        return $this;
    }

    /**
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @param array $emails
     * @return Person
     */
    public function setEmails(array $emails): Person
    {
        $this->emails = $emails;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCmsUserId(): ?string
    {
        return $this->cmsUserId;
    }

    /**
     * @param string|null $cmsUserId
     * @return Person
     */
    public function setCmsUserId(?string $cmsUserId): Person
    {
        $this->cmsUserId = $cmsUserId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOptigemId(): ?string
    {
        return $this->optigemId;
    }

    /**
     * @param string|null $optigemId
     * @return Person
     */
    public function setOptigemId(?string $optigemId): Person
    {
        $this->optigemId = $optigemId;
        return $this;
    }

    /**
     * @return array
     */
    public function getPrivacyPolicyAgreement(): array
    {
        return $this->privacyPolicyAgreement;
    }

    /**
     * @param array $privacyPolicyAgreement
     * @return Person
     */
    public function setPrivacyPolicyAgreement(array $privacyPolicyAgreement): Person
    {
        $this->privacyPolicyAgreement = $privacyPolicyAgreement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrivacyPolicyAgreementDate(): ?string
    {
        return $this->privacyPolicyAgreementDate;
    }

    /**
     * @param string|null $privacyPolicyAgreementDate
     * @return Person
     */
    public function setPrivacyPolicyAgreementDate(?string $privacyPolicyAgreementDate): Person
    {
        $this->privacyPolicyAgreementDate = $privacyPolicyAgreementDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrivacyPolicyAgreementTypeId(): ?int
    {
        return $this->privacyPolicyAgreementTypeId;
    }

    /**
     * @param int|null $privacyPolicyAgreementTypeId
     * @return Person
     */
    public function setPrivacyPolicyAgreementTypeId(?int $privacyPolicyAgreementTypeId): Person
    {
        $this->privacyPolicyAgreementTypeId = $privacyPolicyAgreementTypeId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrivacyPolicyAgreementWhoId(): ?int
    {
        return $this->privacyPolicyAgreementWhoId;
    }

    /**
     * @param int|null $privacyPolicyAgreementWhoId
     * @return Person
     */
    public function setPrivacyPolicyAgreementWhoId(?int $privacyPolicyAgreementWhoId): Person
    {
        $this->privacyPolicyAgreementWhoId = $privacyPolicyAgreementWhoId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNationalityId(): ?int
    {
        return $this->nationalityId;
    }

    /**
     * @param int|null $nationalityId
     * @return Person
     */
    public function setNationalityId(?int $nationalityId): Person
    {
        $this->nationalityId = $nationalityId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFamilyStatusId(): ?int
    {
        return $this->familyStatusId;
    }

    /**
     * @param int|null $familyStatusId
     * @return Person
     */
    public function setFamilyStatusId(?int $familyStatusId): Person
    {
        $this->familyStatusId = $familyStatusId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeddingDate(): ?string
    {
        return $this->weddingDate;
    }

    /**
     * @param string|null $weddingDate
     * @return Person
     */
    public function setWeddingDate(?string $weddingDate): Person
    {
        $this->weddingDate = $weddingDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstContact(): ?string
    {
        return $this->firstContact;
    }

    /**
     * @param string|null $firstContact
     * @return Person
     */
    public function setFirstContact(?string $firstContact): Person
    {
        $this->firstContact = $firstContact;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfBelonging(): ?string
    {
        return $this->dateOfBelonging;
    }

    /**
     * @param string|null $dateOfBelonging
     * @return Person
     */
    public function setDateOfBelonging(?string $dateOfBelonging): Person
    {
        $this->dateOfBelonging = $dateOfBelonging;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfEntry(): ?string
    {
        return $this->dateOfEntry;
    }

    /**
     * @param string|null $dateOfEntry
     * @return Person
     */
    public function setDateOfEntry(?string $dateOfEntry): Person
    {
        $this->dateOfEntry = $dateOfEntry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfResign(): ?string
    {
        return $this->dateOfResign;
    }

    /**
     * @param string|null $dateOfResign
     * @return Person
     */
    public function setDateOfResign(?string $dateOfResign): Person
    {
        $this->dateOfResign = $dateOfResign;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfBaptism(): ?string
    {
        return $this->dateOfBaptism;
    }

    /**
     * @param string|null $dateOfBaptism
     * @return Person
     */
    public function setDateOfBaptism(?string $dateOfBaptism): Person
    {
        $this->dateOfBaptism = $dateOfBaptism;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceOfBaptism(): ?string
    {
        return $this->placeOfBaptism;
    }

    /**
     * @param string|null $placeOfBaptism
     * @return Person
     */
    public function setPlaceOfBaptism(?string $placeOfBaptism): Person
    {
        $this->placeOfBaptism = $placeOfBaptism;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBaptisedBy(): ?string
    {
        return $this->baptisedBy;
    }

    /**
     * @param string|null $baptisedBy
     * @return Person
     */
    public function setBaptisedBy(?string $baptisedBy): Person
    {
        $this->baptisedBy = $baptisedBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferredBy(): ?string
    {
        return $this->referredBy;
    }

    /**
     * @param string|null $referredBy
     * @return Person
     */
    public function setReferredBy(?string $referredBy): Person
    {
        $this->referredBy = $referredBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferredTo(): ?string
    {
        return $this->referredTo;
    }

    /**
     * @param string|null $referredTo
     * @return Person
     */
    public function setReferredTo(?string $referredTo): Person
    {
        $this->referredTo = $referredTo;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGrowPathId(): ?int
    {
        return $this->growPathId;
    }

    /**
     * @param int|null $growPathId
     * @return Person
     */
    public function setGrowPathId(?int $growPathId): Person
    {
        $this->growPathId = $growPathId;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanChat(): ?bool
    {
        return $this->canChat;
    }

    /**
     * @param bool|null $canChat
     * @return Person
     */
    public function setCanChat(?bool $canChat): Person
    {
        $this->canChat = $canChat;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getChatActive(): ?bool
    {
        return $this->chatActive;
    }

    /**
     * @param bool|null $chatActive
     * @return Person
     */
    public function setChatActive(?bool $chatActive): Person
    {
        $this->chatActive = $chatActive;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInvitationStatus(): ?string
    {
        return $this->invitationStatus;
    }

    /**
     * @param string|null $invitationStatus
     * @return Person
     */
    public function setInvitationStatus(?string $invitationStatus): Person
    {
        $this->invitationStatus = $invitationStatus;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    /**
     * @param bool|null $isArchived
     * @return Person
     */
    public function setIsArchived(?bool $isArchived): Person
    {
        $this->isArchived = $isArchived;
        return $this;
    }
}