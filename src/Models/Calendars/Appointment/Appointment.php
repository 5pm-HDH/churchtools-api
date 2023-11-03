<?php


namespace CTApi\Models\Calendars\Appointment;


use CTApi\Models\AbstractModel;
use CTApi\Models\Calendars\Calendar\Calendar;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Common\File\File;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class Appointment extends AbstractModel
{
    use FillWithData;

    protected ?string $caption = null;
    protected ?string $note = null;
    protected ?string $version = null;
    protected ?Calendar $calendar = null;
    protected ?Address $address = null;
    protected ?string $information = null;
    protected ?File $image = null;
    protected ?string $link = null;
    protected ?bool $isInternal = null;

    protected ?string $base_startDate = null;
    protected ?string $base_endDate = null;

    protected ?string $calculated_startDate = null;
    protected ?string $calculated_endDate = null;


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
                $this->processStartAndEndDate(true, $data);
                $this->fillWithData($data); // inline "base"-array attributes
                break;
            case "calculated":
                $this->processStartAndEndDate(false, $data);
                $this->fillWithData($data); // inline "calculated"-array attributes
                break;
            case "calendar":
                $this->calendar = Calendar::createModelFromData($data);
                break;
            case "meta":
                $this->meta = Meta::createModelFromData($data);
                break;
            case "address":
                $this->address = Address::createModelFromData($data);
                break;
            case "image":
                $this->image = File::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    private function processStartAndEndDate(bool $isBase, array &$data)
    {
        if ($isBase) {
            $this->base_startDate = $data['startDate'] ?? null;
            $this->base_endDate = $data['endDate'] ?? null;
        } else {
            $this->calculated_startDate = $data['startDate'] ?? null;
            $this->calculated_endDate = $data['endDate'] ?? null;
        }

        unset($data['startDate']);
        unset($data['endDate']);
    }

    public function getStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getStartDate());
    }

    public function getEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getEndDate());
    }

    public function getCalculatedStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getCalculatedStartDate());
    }

    public function getCalculatedEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getCalculatedEndDate());
    }

    public function getBaseStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getBaseStartDate());
    }

    public function getBaseEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->getBaseEndDate());
    }

    public function toData(): array
    {
        $data = $this->convertPropertiesToData();
        $data["startDate"] = $this->getStartDate();
        $data["endDate"] = $this->getEndDate();
        return $data;
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
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address|null $address
     * @return Appointment
     */
    public function setAddress(?Address $address): Appointment
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImage(): ?File
    {
        return $this->image;
    }

    /**
     * @param File|null $image
     * @return Appointment
     */
    public function setImage(?File $image): Appointment
    {
        $this->image = $image;
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
        if ($this->calculated_startDate != null) {
            return $this->calculated_startDate;
        }
        return $this->base_startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        if ($this->calculated_endDate != null) {
            return $this->calculated_endDate;
        }
        return $this->base_endDate;
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

    public function getBaseStartDate(): ?string
    {
        return $this->base_startDate;
    }

    public function setBaseStartDate(?string $base_startDate): void
    {
        $this->base_startDate = $base_startDate;
    }

    public function getBaseEndDate(): ?string
    {
        return $this->base_endDate;
    }

    public function setBaseEndDate(?string $base_endDate): void
    {
        $this->base_endDate = $base_endDate;
    }

    public function getCalculatedStartDate(): ?string
    {
        return $this->calculated_startDate;
    }

    public function setCalculatedStartDate(?string $calculated_startDate): void
    {
        $this->calculated_startDate = $calculated_startDate;
    }

    public function getCalculatedEndDate(): ?string
    {
        return $this->calculated_endDate;
    }

    public function setCalculatedEndDate(?string $calculated_endDate): void
    {
        $this->calculated_endDate = $calculated_endDate;
    }
}