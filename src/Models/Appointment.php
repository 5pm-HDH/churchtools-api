<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Appointment
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $caption = null;
    protected ?string $note = null;
    protected ?string $version = null;
    protected ?Calendar $calendar = null;
    protected ?string $information = null;
    protected ?string $link = null;
    protected ?bool $isInternal = null;
    protected ?string $startDate = null;
    protected ?string $endDate = null;
    protected ?string $allDay = null;
    protected ?string $repeatId = null;
    protected ?string $repeatFrequency = null;
    protected ?string $repeatUntil = null;
    protected ?string $repeatOption = null;
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
            case "calendar":
                $this->calendar = Calendar::createModelFromData($data);
                break;
            case "meta":
                $this->meta = Meta::createModelFromData($data);
                break;
            default:
                $this->{$key} = $data;
        }
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
     * @return Appointment
     */
    public function setId(?string $id): Appointment
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
     * @return Appointment
     */
    public function setCaption(?string $caption): Appointment
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
     * @return Appointment
     */
    public function setNote(?string $note): Appointment
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
     * @return Appointment
     */
    public function setVersion(?string $version): Appointment
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return Calendar|null
     */
    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    /**
     * @param Calendar|null $calendar
     * @return Appointment
     */
    public function setCalendar(?Calendar $calendar): Appointment
    {
        $this->calendar = $calendar;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInformation(): ?string
    {
        return $this->information;
    }

    /**
     * @param string|null $information
     * @return Appointment
     */
    public function setInformation(?string $information): Appointment
    {
        $this->information = $information;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return Appointment
     */
    public function setLink(?string $link): Appointment
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsInternal(): ?bool
    {
        return $this->isInternal;
    }

    /**
     * @param bool|null $isInternal
     * @return Appointment
     */
    public function setIsInternal(?bool $isInternal): Appointment
    {
        $this->isInternal = $isInternal;
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
     * @return Appointment
     */
    public function setStartDate(?string $startDate): Appointment
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
     * @return Appointment
     */
    public function setEndDate(?string $endDate): Appointment
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
     * @return Appointment
     */
    public function setAllDay(?string $allDay): Appointment
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
     * @return Appointment
     */
    public function setRepeatId(?string $repeatId): Appointment
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
     * @return Appointment
     */
    public function setRepeatFrequency(?string $repeatFrequency): Appointment
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
     * @return Appointment
     */
    public function setRepeatUntil(?string $repeatUntil): Appointment
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
     * @return Appointment
     */
    public function setRepeatOption(?string $repeatOption): Appointment
    {
        $this->repeatOption = $repeatOption;
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
     * @return Appointment
     */
    public function setMeta(?Meta $meta): Appointment
    {
        $this->meta = $meta;
        return $this;
    }
}