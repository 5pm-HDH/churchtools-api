<?php


namespace CTApi\Models\Events\Event;


use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\DomainAttributeModel;
use CTApi\Models\Common\File\FileRequest;
use CTApi\Models\Common\File\FileRequestBuilder;
use CTApi\Models\Events\Service\EventService;
use CTApi\Traits\Model\FillWithData;
use CTApi\Utils\CTDateTimeService;

class Event extends AbstractModel
{
    use FillWithData;

    protected ?string $guid = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?string $startDate = null;
    protected ?string $endDate = null;
    protected ?bool $chatStatus = null;
    protected ?array $permissions = null;
    protected ?DomainAttributeModel $calendar = null;
    protected ?EventAgenda $agenda = null;
    protected ?array $eventServices = [];

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "agenda":
                $this->setAgenda(EventAgenda::createModelFromData($data));
                break;
            case "eventServices":
                $this->setEventServices(EventService::createModelsFromArray($data));
                break;
            case "calendar":
                $this->setCalendar(DomainAttributeModel::createModelFromData($data));
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }


    public function requestAgenda(): EventAgenda
    {
        return (new EventAgendaRequestBuilder($this->getIdAsInteger()))->get();
    }

    public function requestFiles(): ?FileRequestBuilder
    {
        if (!is_null($this->getId())) {
            return FileRequest::forEvent($this->getIdAsInteger());
        }
        return null;
    }

    public function requestEventServiceWithServiceId(int $serviceId): ?EventService
    {
        $requestedEventServices = array_filter($this->getEventServices() ?? [], function ($eventService) use ($serviceId) {
            return $eventService->getServiceId() == $serviceId;
        });
        if (!empty($requestedEventServices)) {
            return $requestedEventServices[array_key_first($requestedEventServices)];
        }
        return null;
    }

    public function getStartDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->startDate);
    }

    public function getEndDateAsDateTime(): ?\DateTimeImmutable
    {
        return CTDateTimeService::stringToDateTime($this->endDate);
    }

    /**
     * @param string|null $id
     * @return Event
     */
    public function setId(?string $id): Event
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
     * @return Event
     */
    public function setGuid(?string $guid): Event
    {
        $this->guid = $guid;
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
     * @return Event
     */
    public function setName(?string $name): Event
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Event
     */
    public function setDescription(?string $description): Event
    {
        $this->description = $description;
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
     * @return Event
     */
    public function setStartDate(?string $startDate): Event
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
     * @return Event
     */
    public function setEndDate(?string $endDate): Event
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getChatStatus(): ?bool
    {
        return $this->chatStatus;
    }

    /**
     * @param bool|null $chatStatus
     * @return Event
     */
    public function setChatStatus(?bool $chatStatus): Event
    {
        $this->chatStatus = $chatStatus;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    /**
     * @param array|null $permissions
     * @return Event
     */
    public function setPermissions(?array $permissions): Event
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return DomainAttributeModel|null
     */
    public function getCalendar(): ?DomainAttributeModel
    {
        return $this->calendar;
    }

    /**
     * @param DomainAttributeModel|null $calendar
     * @return Event
     */
    public function setCalendar(?DomainAttributeModel $calendar): Event
    {
        $this->calendar = $calendar;
        return $this;
    }

    /**
     * @return EventAgenda|null
     */
    public function getAgenda(): ?EventAgenda
    {
        return $this->agenda;
    }

    /**
     * @param EventAgenda|null $agenda
     * @return Event
     */
    public function setAgenda(?EventAgenda $agenda): Event
    {
        $this->agenda = $agenda;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getEventServices(): ?array
    {
        return $this->eventServices;
    }

    /**
     * @param array|null $eventServices
     * @return Event
     */
    public function setEventServices(?array $eventServices): Event
    {
        $this->eventServices = $eventServices;
        return $this;
    }
}