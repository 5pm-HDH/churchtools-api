<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;
use CTApi\Requests\PersonRequest;

class ResourceBooking
{
    use FillWithData, MetaAttribute;

    protected ?string $id = null;
    protected ?string $caption = null;
    protected ?string $note = null;
    protected ?string $version = null;
    protected ?Resource $resource = null;
    protected ?string $location = null;
    protected ?string $calId = null;
    protected ?string $personId = null;
    protected ?string $showInCal = null;
    protected ?string $statusId = null;
    protected ?string $startDate = null;
    protected ?string $endDate = null;
    protected ?string $allDay = null;
    protected ?string $repeatId = null;
    protected ?string $repeatFrequency = null;
    protected ?string $repeatUntil = null;
    protected ?string $repeatOption = null;
    protected array $additionals = [];
    protected array $exceptions = [];
    protected ?Meta $meta = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "base":
                $this->fillWithData($data); // inline "base"-array attributes
                break;
            case "calculated":
                $this->fillWithData($data); // inline "calculated"-array attributes
                break;
            case "resource":
                $this->resource = Resource::createModelFromData($data);
                break;
            case "meta":
                $this->meta = Meta::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    public function requestPerson(): ?Person
    {
        if (!is_null($this->getPersonId())) {
            return PersonRequest::find((int)$this->getPersonId());
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
     * @return ResourceBooking
     */
    public function setId(?string $id): ResourceBooking
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string|null $caption
     * @return ResourceBooking
     */
    public function setCaption(?string $caption): ResourceBooking
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return ResourceBooking
     */
    public function setNote(?string $note): ResourceBooking
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     * @return ResourceBooking
     */
    public function setVersion(?string $version): ResourceBooking
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return Resource|null
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param Resource|null $resource
     * @return ResourceBooking
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return ResourceBooking
     */
    public function setLocation(?string $location): ResourceBooking
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCalId(): ?string
    {
        return $this->calId;
    }

    /**
     * @param string|null $calId
     * @return ResourceBooking
     */
    public function setCalId(?string $calId): ResourceBooking
    {
        $this->calId = $calId;
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
     * @return ResourceBooking
     */
    public function setPersonId(?string $personId): ResourceBooking
    {
        $this->personId = $personId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShowInCal(): ?string
    {
        return $this->showInCal;
    }

    /**
     * @param string|null $showInCal
     * @return ResourceBooking
     */
    public function setShowInCal(?string $showInCal): ResourceBooking
    {
        $this->showInCal = $showInCal;
        return $this;
    }

    /**
     * Status ID is defined on API-Page.
     * @return string|null
     */
    public function getStatusId(): ?string
    {
        return $this->statusId;
    }

    /**
     * @param string|null $statusId
     * @return ResourceBooking
     */
    public function setStatusId(?string $statusId): ResourceBooking
    {
        $this->statusId = $statusId;
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
     * @return ResourceBooking
     */
    public function setStartDate(?string $startDate): ResourceBooking
    {
        $this->startDate = $startDate;
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
     * @return ResourceBooking
     */
    public function setEndDate(?string $endDate): ResourceBooking
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAllDay(): ?string
    {
        return $this->allDay;
    }

    /**
     * @param string|null $allDay
     * @return ResourceBooking
     */
    public function setAllDay(?string $allDay): ResourceBooking
    {
        $this->allDay = $allDay;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRepeatId(): ?string
    {
        return $this->repeatId;
    }

    /**
     * @param string|null $repeatId
     * @return ResourceBooking
     */
    public function setRepeatId(?string $repeatId): ResourceBooking
    {
        $this->repeatId = $repeatId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRepeatFrequency(): ?string
    {
        return $this->repeatFrequency;
    }

    /**
     * @param string|null $repeatFrequency
     * @return ResourceBooking
     */
    public function setRepeatFrequency(?string $repeatFrequency): ResourceBooking
    {
        $this->repeatFrequency = $repeatFrequency;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRepeatUntil(): ?string
    {
        return $this->repeatUntil;
    }

    /**
     * @param string|null $repeatUntil
     * @return ResourceBooking
     */
    public function setRepeatUntil(?string $repeatUntil): ResourceBooking
    {
        $this->repeatUntil = $repeatUntil;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRepeatOption(): ?string
    {
        return $this->repeatOption;
    }

    /**
     * @param string|null $repeatOption
     * @return ResourceBooking
     */
    public function setRepeatOption(?string $repeatOption): ResourceBooking
    {
        $this->repeatOption = $repeatOption;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionals(): array
    {
        return $this->additionals;
    }

    /**
     * @param array $additionals
     * @return ResourceBooking
     */
    public function setAdditionals(array $additionals): ResourceBooking
    {
        $this->additionals = $additionals;
        return $this;
    }

    /**
     * @return array
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }

    /**
     * @param array $exceptions
     * @return ResourceBooking
     */
    public function setExceptions(array $exceptions): ResourceBooking
    {
        $this->exceptions = $exceptions;
        return $this;
    }

    /**
     * @return Meta|null
     */
    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    /**
     * @param Meta|null $meta
     * @return ResourceBooking
     */
    public function setMeta(?Meta $meta): ResourceBooking
    {
        $this->meta = $meta;
        return $this;
    }
}